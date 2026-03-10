<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    // ... method dashboard, ppdb, spp, daftarUlang tetap sama ...

    /**
     * Helper method untuk cek apakah sudah ada cicilan sebelumnya
     */
    private function cekCicilanSebelumnya($id_siswa, $id_biaya, $tahun_ajaran, $bulan = null)
    {
        $query = Pembayaran::where('id_siswa', $id_siswa)
                          ->where('id_biaya', $id_biaya)
                          ->where('tahun_ajaran', $tahun_ajaran);

        if ($bulan) {
            $query->where('bulan', $bulan);
        }

        return $query->orderBy('cicilan_ke', 'desc')->first();
    }

    /**
     * Store Pembayaran PPDB & Daftar Ulang
     */
    public function storePPDBDaftarUlang(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_biaya' => 'required|exists:biayas,id_biaya',
                'tahun_ajaran' => 'required|string',
                'tipe_bayar' => 'required|in:lunas,cicilan',
                'nominal_dibayar' => 'required|numeric|min:1',
                'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            ]);

            $siswa = auth()->user()->siswa;
            $biaya = Biaya::findOrFail($validated['id_biaya']);

            // Cek apakah sudah ada cicilan sebelumnya
            $pembayaranSebelumnya = $this->cekCicilanSebelumnya(
                $siswa->id_siswa,
                $validated['id_biaya'],
                $validated['tahun_ajaran']
            );

            // Tentukan cicilan
            if ($pembayaranSebelumnya && $pembayaranSebelumnya->cicilan_ke == 1 && $pembayaranSebelumnya->total_cicilan == 2) {
                // Ini cicilan ke-2, harus lunas
                $cicilan_ke = 2;
                $total_cicilan = 2;
                $sisa = 0;
                $nominal_dibayar = $pembayaranSebelumnya->sisa_pembayaran;
                $status = 'belum lunas';
            } else {
                // Pembayaran baru atau lunas
                if ($validated['tipe_bayar'] == 'lunas') {
                    $cicilan_ke = 1;
                    $total_cicilan = 1;
                    $sisa = 0;
                    $nominal_dibayar = $biaya->biaya;
                    $status = 'belum lunas';
                } else {
                    // Cicilan pertama
                    $cicilan_ke = 1;
                    $total_cicilan = 2;
                    $nominal_dibayar = $biaya->biaya / 2;
                    $sisa = $biaya->biaya - $nominal_dibayar;
                    $status = 'belum lunas';
                }
            }

            // Upload file
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $folderPath = storage_path('app/public/bukti_pembayaran');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0775, true);
            }

            Storage::disk('public')->putFileAs('bukti_pembayaran', $file, $filename);

            if (!Storage::disk('public')->exists('bukti_pembayaran/' . $filename)) {
                throw new \Exception('File gagal disimpan ke storage');
            }

            // Simpan ke database
            Pembayaran::create([
                'id_biaya' => $validated['id_biaya'],
                'id_siswa' => $siswa->id_siswa,
                'bulan' => null,
                'tahun_ajaran' => $validated['tahun_ajaran'],
                'nominal_dibayar' => $nominal_dibayar,
                'sisa_pembayaran' => $sisa,
                'status' => $status,
                'bukti_pembayaran' => $filename,
                'kwitansi' => null,
                'cicilan_ke' => $cicilan_ke,
                'total_cicilan' => $total_cicilan,
            ]);

            return redirect()->route('siswa.dashboard')
                ->with('success', 'Pembayaran berhasil diupload. Menunggu verifikasi admin.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal. Periksa file yang diupload (max 10MB).');

        } catch (\Exception $e) {
            \Log::error('Error in storePPDBDaftarUlang: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Store Pembayaran SPP
     */
    public function storeSPP(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_biaya' => 'required|exists:biayas,id_biaya',
                'tahun_ajaran' => 'required|string',
                'bulan' => 'required|string',
                'tipe_bayar' => 'required|in:lunas,cicilan',
                'nominal_dibayar' => 'required|numeric|min:1',
                'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            ]);

            $siswa = auth()->user()->siswa;
            $biaya = Biaya::findOrFail($validated['id_biaya']);

            // Cek apakah sudah ada cicilan sebelumnya untuk bulan ini
            $pembayaranSebelumnya = $this->cekCicilanSebelumnya(
                $siswa->id_siswa,
                $validated['id_biaya'],
                $validated['tahun_ajaran'],
                $validated['bulan']
            );

            // Tentukan cicilan
            if ($pembayaranSebelumnya && $pembayaranSebelumnya->cicilan_ke == 1 && $pembayaranSebelumnya->total_cicilan == 2) {
                // Ini cicilan ke-2, harus lunas
                $cicilan_ke = 2;
                $total_cicilan = 2;
                $sisa = 0;
                $nominal_dibayar = $pembayaranSebelumnya->sisa_pembayaran;
                $status = 'belum lunas';
            } else {
                // Pembayaran baru atau lunas
                if ($validated['tipe_bayar'] == 'lunas') {
                    $cicilan_ke = 1;
                    $total_cicilan = 1;
                    $sisa = 0;
                    $nominal_dibayar = $biaya->biaya;
                    $status = 'belum lunas';
                } else {
                    // Cicilan pertama
                    $cicilan_ke = 1;
                    $total_cicilan = 2;
                    $nominal_dibayar = $biaya->biaya / 2;
                    $sisa = $biaya->biaya - $nominal_dibayar;
                    $status = 'belum lunas';
                }
            }

            // Upload file
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $folderPath = storage_path('app/public/bukti_pembayaran');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0775, true);
            }

            Storage::disk('public')->putFileAs('bukti_pembayaran', $file, $filename);

            if (!Storage::disk('public')->exists('bukti_pembayaran/' . $filename)) {
                throw new \Exception('File gagal disimpan ke storage');
            }

            // Simpan ke database
            Pembayaran::create([
                'id_biaya' => $validated['id_biaya'],
                'id_siswa' => $siswa->id_siswa,
                'bulan' => $validated['bulan'],
                'tahun_ajaran' => $validated['tahun_ajaran'],
                'nominal_dibayar' => $nominal_dibayar,
                'sisa_pembayaran' => $sisa,
                'status' => $status,
                'bukti_pembayaran' => $filename,
                'kwitansi' => null,
                'cicilan_ke' => $cicilan_ke,
                'total_cicilan' => $total_cicilan,
            ]);

            return redirect()->route('siswa.dashboard')
                ->with('success', 'Pembayaran SPP berhasil diupload. Menunggu verifikasi admin.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal. Periksa file yang diupload (max 10MB).');

        } catch (\Exception $e) {
            \Log::error('Error in storeSPP: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function dashboard()
    {
        // Ambil user yang login
        $user = auth()->user();

        // Cek apakah user punya relasi siswa
        if (!$user->siswa) {
            // Kalau tidak ada relasi, redirect dengan error
            return redirect()->route('login')->with('error', 'Data siswa tidak ditemukan. Hubungi admin.');
        }

        $siswa = $user->siswa;

        // Hitung tahun ajaran
        $bulanSekarang = date('n');
        if ($bulanSekarang >= 7) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        } else {
            $tahunAjaran = (date('Y') - 1) . '/' . date('Y');
        }

        // Ambil biaya PPDB
        $biayaPPDB = Biaya::where('kategori', 'PPDB')
            ->where('tahun', $tahunAjaran)
            ->whereNull('kelas')
            ->first();

        // Ambil biaya SPP sesuai kelas siswa
        $biayaSPP = Biaya::where('kategori', 'SPP')
            ->where('tahun', $tahunAjaran)
            ->where('kelas', $siswa->kelas_siswa)
            ->first();

        // Ambil biaya Daftar Ulang
        $biayaDaftarUlang = Biaya::where('kategori', 'DAFTAR ULANG')
            ->where('tahun', $tahunAjaran)
            ->whereNull('kelas')
            ->first();

        return view('siswa.dashboard', compact('siswa', 'tahunAjaran', 'biayaPPDB', 'biayaSPP', 'biayaDaftarUlang'));
    }

    /**
     * Update method ppdb() untuk pass data cicilan
     */
    public function ppdb()
    {
        $siswa = auth()->user()->siswa;

        $bulanSekarang = date('n');
        if ($bulanSekarang >= 7) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        } else {
            $tahunAjaran = (date('Y') - 1) . '/' . date('Y');
        }

        $biaya = Biaya::where('kategori', 'PPDB')
                     ->where('tahun', $tahunAjaran)
                     ->whereNull('kelas')
                     ->firstOrFail();

        $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
                                ->where('id_biaya', $biaya->id_biaya)
                                ->where('tahun_ajaran', $tahunAjaran)
                                ->get();

        // Cek apakah sudah ada cicilan pertama
        $cicilanPertama = $pembayaran->where('cicilan_ke', 1)
                                    ->where('total_cicilan', 2)
                                    ->first();

        return view('siswa.ppdb', compact('siswa', 'biaya', 'pembayaran', 'tahunAjaran', 'cicilanPertama'));
    }

    /**
     * Update method daftarUlang() untuk pass data cicilan
     */
    public function daftarUlang()
    {
        $siswa = auth()->user()->siswa;

        $bulanSekarang = date('n');
        if ($bulanSekarang >= 7) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        } else {
            $tahunAjaran = (date('Y') - 1) . '/' . date('Y');
        }

        $biaya = Biaya::where('kategori', 'DAFTAR ULANG')
                     ->where('tahun', $tahunAjaran)
                     ->whereNull('kelas')
                     ->firstOrFail();

        $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
                                ->where('id_biaya', $biaya->id_biaya)
                                ->where('tahun_ajaran', $tahunAjaran)
                                ->get();

        // Cek apakah sudah ada cicilan pertama
        $cicilanPertama = $pembayaran->where('cicilan_ke', 1)
                                    ->where('total_cicilan', 2)
                                    ->first();

        return view('siswa.daftar-ulang', compact('siswa', 'biaya', 'pembayaran', 'tahunAjaran', 'cicilanPertama'));
    }

    /**
     * Update method spp() untuk pass data cicilan per bulan
     */
    public function spp()
    {
        $siswa = auth()->user()->siswa;

        $bulanSekarang = date('n');
        if ($bulanSekarang >= 7) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        } else {
            $tahunAjaran = (date('Y') - 1) . '/' . date('Y');
        }

        $biaya = Biaya::where('kategori', 'SPP')
                     ->where('tahun', $tahunAjaran)
                     ->where('kelas', $siswa->kelas_siswa)
                     ->firstOrFail();

        $bulanList = [
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'
        ];

        $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
                                ->where('id_biaya', $biaya->id_biaya)
                                ->where('tahun_ajaran', $tahunAjaran)
                                ->get();

        // Buat array status per bulan DAN cek cicilan
        $statusBulan = [];
        $cicilanPerBulan = [];

        foreach ($bulanList as $bulan) {
            $pembayaranBulan = $pembayaran->where('bulan', $bulan);

            // Hitung total yang sudah dibayar
            $totalDibayar = $pembayaranBulan->sum('nominal_dibayar');

            // Cek apakah lunas
            if ($totalDibayar >= $biaya->biaya) {
                $statusBulan[$bulan] = 'lunas';
            } else {
                $statusBulan[$bulan] = 'belum bayar';
            }

            // Cek apakah ada cicilan pertama
            $cicilanPertama = $pembayaranBulan->where('cicilan_ke', 1)
                                             ->where('total_cicilan', 2)
                                             ->first();

            $cicilanPerBulan[$bulan] = $cicilanPertama;
        }

        return view('siswa.spp', compact(
            'siswa',
            'biaya',
            'bulanList',
            'statusBulan',
            'pembayaran',
            'tahunAjaran',
            'cicilanPerBulan'
        ));
    }

    /**
 * Halaman Histori Pembayaran
 * Menampilkan semua riwayat pembayaran siswa
 */
public function histori()
{
    $siswa = auth()->user()->siswa;

    // Ambil semua pembayaran siswa ini, diurutkan dari terbaru
    $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
                            ->with(['biaya']) // Eager load relasi biaya
                            ->orderBy('created_at', 'desc')
                            ->get();

    return view('siswa.histori', compact('siswa', 'pembayaran'));
}
}
