<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;  // IMPORT PDF LIBRARY

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['biaya', 'siswa'])
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['biaya', 'siswa'])->findOrFail($id);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Method verifikasi pembayaran & generate kwitansi PDF
     */
    public function verifikasi($id)
    {
        // Ambil data pembayaran dengan relasi
        // ->with() = eager loading untuk ambil relasi biaya & siswa sekaligus
        $pembayaran = Pembayaran::with(['biaya', 'siswa'])->findOrFail($id);

        // Generate nama file kwitansi yang unik
        // 'kwitansi_' = prefix
        // date('Ymd_His') = tanggal & waktu (misal: 20250127_143052)
        // '_' . $pembayaran->id_pembayaran = ID pembayaran
        // '.pdf' = ekstensi file
        // Contoh hasil: kwitansi_20250127_143052_1.pdf
        $filename = 'kwitansi_' . date('Ymd_His') . '_' . $pembayaran->id_pembayaran . '.pdf';

        // Generate PDF dari view
        // Pdf::loadView() = load view blade dan convert jadi PDF
        // 'kwitansi.template' = view template kwitansi (nanti kita buat)
        // compact('pembayaran') = kirim data pembayaran ke view
        $pdf = Pdf::loadView('kwitansi.template', compact('pembayaran'));

        // Simpan PDF ke storage
        // storage_path() = path ke folder storage/app/
        // 'app/public/kwitansi/' = subfolder untuk simpan kwitansi
        // $filename = nama file yang sudah digenerate
        $pdf->save(storage_path('app/public/kwitansi/' . $filename));

        // Update data pembayaran di database
        // Update 2 field: status jadi 'lunas' dan simpan nama file kwitansi
        $pembayaran->update([
            'status' => 'lunas',          // Ubah status jadi lunas
            'kwitansi' => $filename,      // Simpan nama file kwitansi
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diverifikasi dan kwitansi telah dibuat.');
    }

    public function tolak($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Hapus file bukti pembayaran
        $filePath = storage_path('app/public/bukti_pembayaran/' . $pembayaran->bukti_pembayaran);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Hapus data pembayaran
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditolak dan dihapus.');
    }

    /**
     * Method untuk download kwitansi PDF
     * Dipanggil saat siswa klik "Download Kwitansi"
     */
    public function downloadKwitansi($id)
    {
        // Ambil data pembayaran
        $pembayaran = Pembayaran::findOrFail($id);

        // Cek apakah kwitansi sudah digenerate
        // Kalau belum ada (NULL), tampilkan error
        if (!$pembayaran->kwitansi) {
            // abort(404) = tampilkan halaman 404 Not Found
            abort(404, 'Kwitansi belum tersedia. Menunggu verifikasi admin.');
        }

        // Path file kwitansi di storage
        $filePath = storage_path('app/public/kwitansi/' . $pembayaran->kwitansi);

        // Cek apakah file exist di server
        if (!file_exists($filePath)) {
            abort(404, 'File kwitansi tidak ditemukan.');
        }

        // Download file
        // response()->download() = trigger download file ke browser
        // Parameter 1: path file
        // Parameter 2: nama file saat didownload (opsional)
        return response()->download($filePath);
    }
}
