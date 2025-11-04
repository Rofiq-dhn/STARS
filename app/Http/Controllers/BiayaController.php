<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    // Tampilkan semua data biaya
    public function index()
    {
        $biaya = Biaya::all();
        return view('admin.biaya.index', compact('biaya'));
    }

    // Tampilkan form tambah biaya
    public function create()
    {
        return view('admin.biaya.create');
    }

    // Simpan data biaya baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:20',
            'tahun' => 'required|string|max:20',
            'biaya' => 'required|numeric',
            'kelas' => 'nullable|string|max:4',
        ]);

        // Auto uppercase kelas
        if (!empty($validated['kelas'])) {
            $validated['kelas'] = strtoupper($validated['kelas']);
        }

        Biaya::create($validated);

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil ditambahkan.');
    }

    // Tampilkan form edit biaya
    public function edit(Biaya $biaya)
    {
        return view('admin.biaya.edit', compact('biaya'));
    }

    // Update data biaya di database
    public function update(Request $request, Biaya $biaya)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:20',
            'tahun' => 'required|string|max:20',
            'biaya' => 'required|numeric',
            'kelas' => 'nullable|string|max:4',
        ]);

        // Auto uppercase kelas
        if (!empty($validated['kelas'])) {
            $validated['kelas'] = strtoupper($validated['kelas']);
        }

        $biaya->update($validated);

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil diupdate.');
    }

    // Hapus data biaya dari database
    public function destroy(Biaya $biaya)
    {
        $biaya->delete();

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil dihapus.');
    }
}
