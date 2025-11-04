<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Biaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->level == 'admin') {
            $pembayaran = Pembayaran::with(['siswa','biaya'])->get();
            return view('admin.pembayaran.index', compact('pembayaran'));
        }

        $pembayaran = Pembayaran::where('id_siswa', $user->id_siswa)
                               ->with('biaya')
                               ->get();
        return view('siswa.pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $biaya = Biaya::all();
        return view('siswa.pembayaran.create', compact('biaya'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_biaya' => 'required',
            'nominal_dibayar' => 'required|numeric',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $bukti = $request->file('bukti_pembayaran');
        $buktiName = time().'.'.$bukti->extension();
        $bukti->move(public_path('uploads/bukti'), $buktiName);

        Pembayaran::create([
            'id_biaya' => $request->id_biaya,
            'id_siswa' => Auth::user()->id_siswa,
            'bulan' => date('F'),
            'nominal_dibayar' => $request->nominal_dibayar,
            'status' => 'belum lunas',
            'bukti_pembayaran' => 'uploads/bukti/'.$buktiName,
            'tahun' => date('Y')
        ]);

        return redirect()->route('pembayaran.index')
                        ->with('success', 'Pembayaran berhasil disubmit');
    }

    public function validasi($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = 'lunas';
        $pembayaran->kwitansi = 'KWT-'.time();
        $pembayaran->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil divalidasi');
    }
}
