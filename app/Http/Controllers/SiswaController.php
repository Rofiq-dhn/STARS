<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard()
    {
        // TEMPORARY: Ambil siswa by ID (hardcode untuk testing tanpa login)
        // Nanti kalau login aktif, ganti jadi: $siswa = auth()->user()->siswa;
        $siswa = \App\Models\Siswa::find(1);  // Siswa dengan id_siswa = 1

        // Ambil semua tagihan yang sesuai dengan kelas siswa
        $tagihan = Biaya::where('kelas', $siswa->kelas_siswa)
                        ->orWhereNull('kelas')
                        ->get();

        // Ambil riwayat pembayaran siswa ini
        $riwayat = Pembayaran::where('id_siswa', $siswa->id_siswa)
                            ->with('biaya')
                            ->orderBy('created_at', 'desc')
                            ->get();

        // Hitung total tagihan belum lunas
        $totalTagihan = $riwayat->where('status', 'belum lunas')->sum('sisa_pembayaran');

        // Hitung total sudah dibayar
        $totalBayar = $riwayat->where('status', 'lunas')->sum('nominal_dibayar');

        return view('siswa.dashboard', compact('siswa', 'tagihan', 'riwayat', 'totalTagihan', 'totalBayar'));
    }
}
