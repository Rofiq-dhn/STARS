<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Method untuk menampilkan dashboard siswa
     */
    public function dashboard()
    {
        // Ambil siswa by ID (sementara hardcode)
        $siswa = Siswa::find(1);

        // Ambil tagihan sesuai kelas siswa
        $tagihan = Biaya::where('kelas', $siswa->kelas_siswa)
                        ->orWhereNull('kelas')
                        ->get();

        // Ambil riwayat pembayaran
        $riwayat = Pembayaran::where('id_siswa', $siswa->id_siswa)
                            ->with('biaya')
                            ->orderBy('created_at', 'desc')
                            ->get();

        // Hitung total
        $totalTagihan = $riwayat->where('status', 'belum lunas')->sum('sisa_pembayaran');
        $totalBayar = $riwayat->where('status', 'lunas')->sum('nominal_dibayar');

        return view('siswa.dashboard', compact('siswa', 'tagihan', 'riwayat', 'totalTagihan', 'totalBayar'));
    }

    /**
     * Method untuk menampilkan form bayar tagihan
     * Dipanggil saat siswa klik tombol "Bayar" di daftar tagihan
     */
    public function formBayar($id_biaya)
    {
        // Ambil siswa (sementara hardcode)
        $siswa = Siswa::find(1);

        // Ambil data biaya berdasarkan ID yang dipilih
        // Biaya::findOrFail() = cari by primary key, kalau tidak ada throw error 404
        $biaya = Biaya::findOrFail($id_biaya);

        // Return ke view form bayar
        // Kirim variabel $siswa dan $biaya ke view
        return view('siswa.form-bayar', compact('siswa', 'biaya'));
    }

    /**
     * Method untuk menyimpan pembayaran & upload bukti transfer
     * Dipanggil saat siswa submit form pembayaran
     */
    public function storeBayar(Request $request)
    {
        // Validasi input dari form
        // $request->validate() = cek apakah data sesuai aturan
        $validated = $request->validate([
            'id_biaya' => 'required|exists:biayas,id_biaya',  // id_biaya wajib ada & harus exist di tabel biayas
            'bulan' => 'required|string',                      // bulan wajib diisi
            'tahun' => 'required|string|size:4',               // tahun wajib 4 karakter (misal: 2025)
            'nominal_dibayar' => 'required|numeric|min:1',     // nominal wajib angka & minimal 1
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',  // file wajib, format jpg/png/pdf, max 2MB
        ]);

        // Ambil siswa (sementara hardcode)
        $siswa = Siswa::find(1);

        // Ambil data biaya
        $biaya = Biaya::findOrFail($validated['id_biaya']);

        // Hitung sisa pembayaran
        // Sisa = Total Biaya - Nominal yang Dibayar
        $sisa = $biaya->biaya - $validated['nominal_dibayar'];

        // Tentukan status pembayaran
        // Kalau sisa = 0 atau kurang, status jadi "lunas"
        // Kalau masih ada sisa, status "belum lunas"
        if ($sisa <= 0) {
            $status = 'lunas';      // Sudah lunas
            $sisa = 0;              // Sisa jadi 0 (tidak boleh minus)
        } else {
            $status = 'belum lunas';  // Masih ada sisa
        }

        // Upload file bukti pembayaran
        // $request->file() = ambil file yang diupload
        $file = $request->file('bukti_pembayaran');

        // Generate nama file unik
        // time() = timestamp sekarang (misal: 1698765432)
        // $file->getClientOriginalExtension() = ambil ekstensi file (jpg, png, pdf)
        // Hasil: bukti_1698765432.jpg
        $filename = 'bukti_' . time() . '.' . $file->getClientOriginalExtension();

        // Simpan file ke storage
        // storeAs() = simpan file dengan nama tertentu
        // 'public/bukti_pembayaran' = folder tujuan di storage/app/public/bukti_pembayaran
        // $filename = nama file yang sudah digenerate
        $file->storeAs('public/bukti_pembayaran', $filename);

        // Simpan data pembayaran ke database
        // Pembayaran::create() = INSERT INTO pembayarans
        Pembayaran::create([
            'id_biaya' => $validated['id_biaya'],              // ID biaya yang dibayar
            'id_siswa' => $siswa->id_siswa,                    // ID siswa yang bayar
            'bulan' => $validated['bulan'],                    // Bulan pembayaran
            'tahun' => $validated['tahun'],                    // Tahun pembayaran
            'nominal_dibayar' => $validated['nominal_dibayar'], // Nominal yang dibayar
            'sisa_pembayaran' => $sisa,                        // Sisa yang belum dibayar
            'status' => $status,                               // Status: lunas / belum lunas
            'bukti_pembayaran' => $filename,                   // Nama file bukti yang diupload
            'kwitansi' => null,                                // Kwitansi belum ada (nanti digenerate admin)
        ]);

        // Redirect ke dashboard dengan pesan sukses
        // redirect()->route() = redirect ke route tertentu
        // ->with('success', ...) = kirim pesan ke session
        return redirect()->route('siswa.dashboard')->with('success', 'Bukti pembayaran berhasil diupload. Menunggu verifikasi admin.');
    }
}
