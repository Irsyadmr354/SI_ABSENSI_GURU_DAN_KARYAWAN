<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JamKerja;
use Illuminate\Http\Request;

class JamKerjaController extends Controller
{
    public function index()
    {
        $jamKerja = JamKerja::paginate(15);
        return view('admin.jam-kerja.index', compact('jamKerja'));
    }

    public function create()
    {
        return view('admin.jam-kerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_pulang' => 'required|date_format:H:i|after:jam_masuk',
            'toleransi_keterlambatan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Jika set active, nonaktifkan yang lain
        if ($request->filled('is_active')) {
            JamKerja::where('is_active', true)->update(['is_active' => false]);
        }

        JamKerja::create($request->all());

        return redirect()->route('admin.jam-kerja.index')->with('success', 'Data jam kerja berhasil ditambahkan.');
    }

    public function edit(JamKerja $jamKerja)
    {
        return view('admin.jam-kerja.edit', compact('jamKerja'));
    }

    public function update(Request $request, JamKerja $jamKerja)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_pulang' => 'required|date_format:H:i|after:jam_masuk',
            'toleransi_keterlambatan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Jika set active, nonaktifkan yang lain
        if ($request->filled('is_active') && $request->is_active) {
            JamKerja::where('id', '!=', $jamKerja->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        $jamKerja->update($request->all());

        return redirect()->route('admin.jam-kerja.index')->with('success', 'Data jam kerja berhasil diperbarui.');
    }

    public function destroy(JamKerja $jamKerja)
    {
        $jamKerja->delete();
        return redirect()->route('admin.jam-kerja.index')->with('success', 'Data jam kerja berhasil dihapus.');
    }
}
