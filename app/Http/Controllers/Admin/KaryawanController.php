<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::with('user', 'jabatan')->paginate(15);
        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $jabatan = Jabatan::all();
        return view('admin.karyawan.create', compact('jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'nip' => 'required|string|unique:karyawan,nip',
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'karyawan',
            'is_active' => true,
        ]);

        Karyawan::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit(Karyawan $karyawan)
    {
        $jabatan = Jabatan::all();
        $karyawan->load('user');
        return view('admin.karyawan.edit', compact('karyawan', 'jabatan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $karyawan->user_id,
            'password' => 'nullable|min:8',
            'nip' => 'required|string|unique:karyawan,nip,' . $karyawan->id,
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        $karyawan->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $karyawan->user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $karyawan->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);

        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->user->delete();
        return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
