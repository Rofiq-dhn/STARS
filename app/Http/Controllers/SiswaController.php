<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SiswaController extends Controller
{
    // ============================================
    // DASHBOARD SISWA
    // ============================================

    /**
     * Tampilkan dashboard siswa dengan 3 pilihan pembayaran:
     * 1. PPDB
     * 2. SPP
     * 3. Daftar Ulang
     */
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

    // ============================================
    // HALAMAN PEMBAYARAN PPDB
    // ============================================

    /**
     * Halaman pembayaran PPDB
     * Menampilkan:
     * - Detail biaya PPDB
     * - History pembayaran PPDB (jika ada)
     * - Form pembayaran (Lunas/Cicilan)
     */
    public function ppdb()
    {
        // Ambil data siswa yang login
        $siswa = auth()->user()->siswa;

        // Hitung tahun ajaran (logic sama dengan method dashboard)
        $bulanSekarang = date('n');
        if ($bulanSekarang >= 7) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        } else {
            $tahunAjaran = (date('Y') - 1) . '/' . date('Y');
        }

        // Ambil data biaya PPDB
        // firstOrFail() = ambil data pertama, kalau tidak ada throw error 404
        $biaya = Biaya::where('kategori', 'PPDB')
            ->where('tahun', $tahunAjaran)
            ->whereNull('kelas')
            ->firstOrFail();

        // Ambil history pembayaran PPDB siswa ini
        // get() = ambil semua data yang match (return collection)
        $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
            ->where('id_biaya', $biaya->id_biaya)
            ->where('tahun_ajaran', $tahunAjaran)
            ->get();

        // Kirim data ke view
        return view('siswa.ppdb', compact('siswa', 'biaya', 'pembayaran', 'tahunAjaran'));
    }

    // ============================================
    // HALAMAN PEMBAYARAN SPP
    // ============================================

    /**
     * Halaman pembayaran SPP
     * Menampilkan:
     * - Status pembayaran per bulan (Lunas/Belum Lunas)
     * - Form pilih bulan (multiple select)
     * - Form pembayaran (Lunas/Cicilan)
     */
    public function spp()
    {
        // Ambil data siswa yang login
        $siswa = auth()->user()->siswa;

        // Hitung tahun ajaran
        $bulanSekarang = date('n');
        if ($bulanSekarang >= 7) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        } else {
            $tahunAjaran = (date('Y') - 1) . '/' . date('Y');
        }

        // Ambil data biaya SPP sesuai kelas siswa
        $biaya = Biaya::where('kategori', 'SPP')
            ->where('tahun', $tahunAjaran)
            ->where('kelas', $siswa->kelas_siswa)
            ->firstOrFail();

        // ============================================
        // DAFTAR BULAN (Juli - Juni)
        // ============================================

        // Array bulan dalam format bahasa Inggris
        // Urutan: Juli (awal tahun ajaran) sampai Juni (akhir tahun ajaran)
        $bulanList = [
            'Juli',       // Juli (bulan 7)
            'Agustus',     // Agustus (bulan 8)
            'September',  // September (bulan 9)
            'Oktober',    // Oktober (bulan 10)
            'November',   // November (bulan 11)
            'Desember',   // Desember (bulan 12)
            'Januari',    // Januari (bulan 1)
            'Februari',   // Februari (bulan 2)
            'Maret',      // Maret (bulan 3)
            'April',      // April (bulan 4)
            'Mei',        // Mei (bulan 5)
            'Juni'        // Juni (bulan 6)
        ];

        // ============================================
        // AMBIL HISTORY PEMBAYARAN SPP
        // ============================================

        // Ambil semua pembayaran SPP siswa ini untuk tahun ajaran ini
        $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
            ->where('id_biaya', $biaya->id_biaya)
            ->where('tahun_ajaran', $tahunAjaran)
            ->get();

        // ============================================
        // BUAT ARRAY STATUS PER BULAN
        // ============================================

        // Buat array kosong untuk simpan status tiap bulan
        // Format: ['July' => 'lunas', 'August' => 'belum bayar', ...]
        $statusBulan = [];

        // Loop semua bulan
        foreach ($bulanList as $bulan) {
            // where() di collection Laravel = filter data
            // ->first() = ambil data pertama yang match
            $bayar = $pembayaran->where('bulan', $bulan)->first();

            // Kalau ada data pembayaran, ambil statusnya
            // Kalau tidak ada, set status 'belum bayar'
            // Ternary operator: kondisi ? nilai_jika_true : nilai_jika_false
            $statusBulan[$bulan] = $bayar ? $bayar->status : 'belum bayar';
        }

        // Kirim data ke view
        return view('siswa.spp', compact(
            'siswa',         // Data siswa
            'biaya',         // Data biaya SPP
            'bulanList',     // Array list bulan
            'statusBulan',   // Array status per bulan
            'pembayaran',    // History pembayaran (untuk detail)
            'tahunAjaran'    // Tahun ajaran aktif
        ));
    }

    // ============================================
    // HALAMAN PEMBAYARAN DAFTAR ULANG
    // ============================================

    /**
     * Halaman pembayaran Daftar Ulang
     * Menampilkan:
     * - Detail biaya Daftar Ulang
     * - History pembayaran Daftar Ulang (jika ada)
     * - Form pembayaran (Lunas/Cicilan)
     */
    public function daftarUlang()
    {
        // Ambil data siswa yang login
        $siswa = auth()->user()->siswa;

        // Hitung tahun ajaran
        $bulanSekarang = date('n');
        if ($bulanSekarang >= 7) {
            $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
        } else {
            $tahunAjaran = (date('Y') - 1) . '/' . date('Y');
        }

        // Ambil data biaya Daftar Ulang
        $biaya = Biaya::where('kategori', 'DAFTAR ULANG')
            ->where('tahun', $tahunAjaran)
            ->whereNull('kelas')
            ->firstOrFail();

        // Ambil history pembayaran Daftar Ulang siswa ini
        $pembayaran = Pembayaran::where('id_siswa', $siswa->id_siswa)
            ->where('id_biaya', $biaya->id_biaya)
            ->where('tahun_ajaran', $tahunAjaran)
            ->get();

        // Kirim data ke view
        return view('siswa.daftar-ulang', compact('siswa', 'biaya', 'pembayaran', 'tahunAjaran'));
    }

    // ============================================
    // STORE PEMBAYARAN PPDB & DAFTAR ULANG
    // ============================================

    /**
     * Proses submit pembayaran PPDB atau Daftar Ulang
     * Logic sama karena:
     * - Tidak ada pilihan bulan
     * - Ada opsi Lunas/Cicilan (2x)
     * - Upload bukti pembayaran
     */
    public function storePPDBDaftarUlang(Request $request)
    {
        try {
            // ✅ Ubah dari 2048 (2MB) jadi 10240 (10MB)
            $validated = $request->validate([
                'id_biaya' => 'required|exists:biayas,id_biaya',
                'tahun_ajaran' => 'required|string',
                'tipe_bayar' => 'required|in:lunas,cicilan',
                'nominal_dibayar' => 'required|numeric|min:1',
                'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // ✅ UBAH JADI 10MB
            ]);

            $siswa = auth()->user()->siswa;
            $biaya = Biaya::findOrFail($validated['id_biaya']);

            // Hitung cicilan
            if ($validated['tipe_bayar'] == 'lunas') {
                $sisa = 0;
                $status = 'belum lunas';
                $cicilan_ke = 1;
                $total_cicilan = 1;
            } else {
                $cicilan_ke = 1;
                $total_cicilan = 2;
                $sisa = $biaya->biaya - $validated['nominal_dibayar'];
                $status = 'belum lunas';
            }

            // Upload file
            $file = $request->file('bukti_pembayaran');
            $filename = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pastikan folder ada
            $folderPath = storage_path('app/public/bukti_pembayaran');
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0775, true);
            }

            // Simpan file - LANGSUNG PAKAI Storage facade
            Storage::disk('public')->putFileAs('bukti_pembayaran', $file, $filename);

            // Verifikasi file tersimpan
            if (!Storage::disk('public')->exists('bukti_pembayaran/' . $filename)) {
                throw new \Exception('File gagal disimpan ke storage');
            }

            // Simpan ke database
            Pembayaran::create([
                'id_biaya' => $validated['id_biaya'],
                'id_siswa' => $siswa->id_siswa,
                'bulan' => null,
                'tahun_ajaran' => $validated['tahun_ajaran'],
                'nominal_dibayar' => $validated['nominal_dibayar'],
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
            // Error validasi (termasuk ukuran file)
            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Validasi gagal. Periksa file yang diupload (max 10MB).');
        } catch (\Exception $e) {
            \Log::error('Error in storePPDBDaftarUlang: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ============================================
    // STORE PEMBAYARAN SPP
    // ============================================

   public function storeSPP(Request $request)
{
    try {
        $validated = $request->validate([
            'id_biaya' => 'required|exists:biayas,id_biaya',
            'tahun_ajaran' => 'required|string',
            'bulan' => 'required|string', // ✅ UBAH: dari array jadi string
            'tipe_bayar' => 'required|in:lunas,cicilan',
            'nominal_dibayar' => 'required|numeric|min:1',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $siswa = auth()->user()->siswa;
        $biaya = Biaya::findOrFail($validated['id_biaya']);

        // Upload file
        $file = $request->file('bukti_pembayaran');
        $filename = 'bukti_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Pastikan folder ada
        $folderPath = storage_path('app/public/bukti_pembayaran');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0775, true);
        }

        // Simpan file
        Storage::disk('public')->putFileAs('bukti_pembayaran', $file, $filename);

        if (!Storage::disk('public')->exists('bukti_pembayaran/' . $filename)) {
            throw new \Exception('File gagal disimpan ke storage');
        }

        // Hitung cicilan berdasarkan tipe bayar
        if ($validated['tipe_bayar'] == 'lunas') {
            $sisa = 0;
            $status = 'belum lunas';
            $cicilan_ke = 1;
            $total_cicilan = 1;
        } else {
            $cicilan_ke = 1;
            $total_cicilan = 2;
            $sisa = $biaya->biaya - $validated['nominal_dibayar'];
            $status = 'belum lunas';
        }

        // Simpan pembayaran untuk 1 bulan saja
        Pembayaran::create([
            'id_biaya' => $validated['id_biaya'],
            'id_siswa' => $siswa->id_siswa,
            'bulan' => $validated['bulan'], // ✅ Langsung ambil string bulan
            'tahun_ajaran' => $validated['tahun_ajaran'],
            'nominal_dibayar' => $validated['nominal_dibayar'],
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
