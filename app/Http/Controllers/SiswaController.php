<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

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
        // ============================================
        // VALIDASI INPUT
        // ============================================

        // $request->validate() = validasi input dari form
        // Kalau ada yang error, otomatis redirect balik ke form dengan error message
        $validated = $request->validate([
            // id_biaya harus ada dan harus exist di tabel biayas
            'id_biaya' => 'required|exists:biayas,id_biaya',

            // tahun_ajaran harus ada dan berupa string
            'tahun_ajaran' => 'required|string',

            // tipe_bayar harus ada dan hanya boleh 'lunas' atau 'cicilan'
            'tipe_bayar' => 'required|in:lunas,cicilan',

            // nominal_dibayar harus ada, berupa angka, minimal 1
            'nominal_dibayar' => 'required|numeric|min:1',

            // bukti_pembayaran harus ada, berupa file, format jpg/jpeg/png/pdf, max 2MB
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ============================================
        // AMBIL DATA SISWA & BIAYA
        // ============================================

        // Ambil data siswa yang login
        $siswa = auth()->user()->siswa;

        // Ambil data biaya berdasarkan id_biaya dari form
        // findOrFail() = cari berdasarkan primary key, kalau tidak ada throw 404
        $biaya = Biaya::findOrFail($validated['id_biaya']);

        // ============================================
        // HITUNG SISA & STATUS BERDASARKAN TIPE BAYAR
        // ============================================

        // Kalau pilih 'lunas' = bayar penuh
        if ($validated['tipe_bayar'] == 'lunas') {
            $sisa = 0;                    // Tidak ada sisa
            $status = 'belum lunas';      // Status masih belum lunas (nunggu verifikasi admin)
            $cicilan_ke = 1;              // Cicilan ke-1 (sekaligus terakhir)
            $total_cicilan = 1;           // Total cuma 1x bayar
        }
        // Kalau pilih 'cicilan' = bayar 2x
        else {
            $cicilan_ke = 1;              // Ini cicilan pertama
            $total_cicilan = 2;           // Total ada 2x cicilan

            // Hitung sisa = total biaya - nominal yang dibayar
            $sisa = $biaya->biaya - $validated['nominal_dibayar'];

            // Kalau sisa <= 0, berarti sudah lunas
            // Kalau sisa > 0, berarti belum lunas
            $status = $sisa <= 0 ? 'belum lunas' : 'belum lunas';
        }

        // ============================================
        // UPLOAD FILE BUKTI PEMBAYARAN
        // ============================================

        // $request->file() = ambil file yang diupload
        $file = $request->file('bukti_pembayaran');

        // Generate nama file unik
        // 'bukti_' = prefix
        // time() = timestamp sekarang (contoh: 1706345678)
        // '.' = separator
        // getClientOriginalExtension() = ambil ekstensi file (jpg, png, pdf)
        // Contoh hasil: bukti_1706345678.jpg
        $filename = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();

        // Simpan file ke storage
        // storeAs() = simpan file dengan nama custom
        // Parameter 1: folder tujuan ('public/bukti_pembayaran')
        // Parameter 2: nama file ($filename)
        // File akan disimpan di storage/app/public/bukti_pembayaran/
        $file->storeAs('public/bukti_pembayaran', $filename);

        // ============================================
        // SIMPAN DATA PEMBAYARAN KE DATABASE
        // ============================================

        // Pembayaran::create() = insert data baru ke tabel pembayarans
        Pembayaran::create([
            'id_biaya' => $validated['id_biaya'],                // ID biaya
            'id_siswa' => $siswa->id_siswa,                      // ID siswa yang login
            'bulan' => null,                                     // PPDB/Daftar Ulang tidak pakai bulan
            'tahun_ajaran' => $validated['tahun_ajaran'],        // Tahun ajaran
            'nominal_dibayar' => $validated['nominal_dibayar'],  // Nominal yang dibayar
            'sisa_pembayaran' => $sisa,                          // Sisa pembayaran
            'status' => $status,                                 // Status (belum lunas)
            'bukti_pembayaran' => $filename,                     // Nama file bukti
            'kwitansi' => null,                                  // Kwitansi belum digenerate
            'cicilan_ke' => $cicilan_ke,                         // Cicilan ke berapa
            'total_cicilan' => $total_cicilan,                   // Total cicilan
        ]);

        // ============================================
        // REDIRECT DENGAN PESAN SUKSES
        // ============================================

        // redirect()->route() = redirect ke route tertentu
        // ->with() = kirim flash message (session sekali pakai)
        return redirect()->route('siswa.dashboard')->with('success', 'Pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }

    // ============================================
    // STORE PEMBAYARAN SPP
    // ============================================

    /**
     * Proses submit pembayaran SPP
     * Logic berbeda karena:
     * - Ada pilihan bulan (bisa multiple)
     * - Kalau pilih 1 bulan → bisa Lunas/Cicilan
     * - Kalau pilih >1 bulan → hanya Lunas
     */
    public function storeSPP(Request $request)
    {
        // ============================================
        // VALIDASI INPUT
        // ============================================

        $validated = $request->validate([
            'id_biaya' => 'required|exists:biayas,id_biaya',
            'tahun_ajaran' => 'required|string',

            // bulan harus array (karena bisa pilih multiple)
            // min:1 = minimal pilih 1 bulan
            'bulan' => 'required|array|min:1',

            // setiap item di array bulan harus string
            'bulan.*' => 'string',

            'tipe_bayar' => 'required|in:lunas,cicilan',
            'nominal_dibayar' => 'required|numeric|min:1',
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // ============================================
        // AMBIL DATA SISWA & BIAYA
        // ============================================

        $siswa = auth()->user()->siswa;
        $biaya = Biaya::findOrFail($validated['id_biaya']);

        // ============================================
        // UPLOAD FILE BUKTI PEMBAYARAN
        // ============================================

        $file = $request->file('bukti_pembayaran');
        $filename = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/bukti_pembayaran', $filename);

        // ============================================
        // SIMPAN PEMBAYARAN PER BULAN
        // ============================================

        // Loop semua bulan yang dipilih
        // foreach = perulangan untuk array
        foreach ($validated['bulan'] as $bulan) {

            // ============================================
            // HITUNG SISA & STATUS
            // ============================================

            // Kalau bayar lunas
            if ($validated['tipe_bayar'] == 'lunas') {
                $sisa = 0;
                $status = 'belum lunas';  // Nunggu verifikasi admin
                $cicilan_ke = 1;
                $total_cicilan = 1;
            }
            // Kalau bayar cicilan
            else {
                $cicilan_ke = 1;
                $total_cicilan = 2;
                $sisa = $biaya->biaya - $validated['nominal_dibayar'];
                $status = $sisa <= 0 ? 'belum lunas' : 'belum lunas';
            }

            // ============================================
            // INSERT DATA PEMBAYARAN
            // ============================================

            Pembayaran::create([
                'id_biaya' => $validated['id_biaya'],
                'id_siswa' => $siswa->id_siswa,
                'bulan' => $bulan,                                   // Bulan yang dipilih
                'tahun_ajaran' => $validated['tahun_ajaran'],
                'nominal_dibayar' => $validated['nominal_dibayar'],
                'sisa_pembayaran' => $sisa,
                'status' => $status,
                'bukti_pembayaran' => $filename,                     // Semua bulan pakai file yang sama
                'kwitansi' => null,
                'cicilan_ke' => $cicilan_ke,
                'total_cicilan' => $total_cicilan,
            ]);
        }

        // ============================================
        // REDIRECT DENGAN PESAN SUKSES
        // ============================================

        return redirect()->route('siswa.dashboard')->with('success', 'Pembayaran SPP berhasil diupload. Menunggu verifikasi admin.');
    }
}
