<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    public function index()
    {
        $biaya = Biaya::all();
        return view('admin.biaya.index', compact('biaya'));  // UPDATED
    }

    public function create()
    {
        return view('admin.biaya.create');  // UPDATED
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:20',
            'tahun' => 'required|string|max:20',
            'biaya' => 'required|numeric',
            'kelas' => 'nullable|string|max:4',
        ]);

        if (!empty($validated['kelas'])) {
            $validated['kelas'] = strtoupper($validated['kelas']);
        }

        Biaya::create($validated);

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil ditambahkan.');
    }

    public function show(Biaya $biaya)
    {
        return view('admin.biaya.show', compact('biaya'));  // UPDATED
    }

    public function edit(Biaya $biaya)
    {
        return view('admin.biaya.edit', compact('biaya'));  // UPDATED
    }

    public function update(Request $request, Biaya $biaya)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:20',
            'tahun' => 'required|string|max:20',
            'biaya' => 'required|numeric',
            'kelas' => 'nullable|string|max:4',
        ]);

        if (!empty($validated['kelas'])) {
            $validated['kelas'] = strtoupper($validated['kelas']);
        }

        $biaya->update($validated);

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil diupdate.');
    }

    public function destroy(Biaya $biaya)
    {
        $biaya->delete();

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil dihapus.');
    }
}
