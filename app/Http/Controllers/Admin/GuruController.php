<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user', 'jabatan')->paginate(15);
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        $jabatan = Jabatan::all();
        return view('admin.guru.create', compact('jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nip' => 'required|string|unique:guru,nip',
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'guru',
            'is_active' => true,
        ]);

        Guru::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        $jabatan = Jabatan::all();
        $guru->load('user');
        return view('admin.guru.edit', compact('guru', 'jabatan'));
    }

    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $guru->user_id,
            'password' => 'nullable|min:8',
            'nip' => 'required|string|unique:guru,nip,' . $guru->id,
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        $guru->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $guru->user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $guru->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->user->delete(); // Cascade will delete guru record
        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
