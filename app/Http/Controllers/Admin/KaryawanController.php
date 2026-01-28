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
        $pendingUsers = User::where('role', 'karyawan')
            ->where('is_active', true)
            ->doesntHave('karyawan')
            ->get();
        return view('admin.karyawan.index', compact('karyawan', 'pendingUsers'));
    }

    public function create(Request $request)
    {
        $jabatan = Jabatan::all();
        $user = null;
        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
        }
        return view('admin.karyawan.create', compact('jabatan', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email' . ($request->has('user_id') ? '' : '|unique:users,email'),
            'password' => $request->has('user_id') ? 'nullable|min:8' : 'required|min:8',
            'nip' => 'required|string|unique:karyawan,nip',
            'nama' => 'required|string|max:255',
            'jabatan_id' => 'nullable|exists:jabatan,id',
            'alamat' => 'nullable|string',
            'no_telp' => 'nullable|string',
        ]);

        // Detect potential role mismatch
        $jabatan = null;
        if ($request->filled('jabatan_id')) {
            $jabatan = Jabatan::find($request->jabatan_id);
        }

        // If Jabatan implies 'guru', switch to Guru
        if ($jabatan && strtolower($jabatan->nama_jabatan) === 'guru') {
            
            if ($request->has('user_id')) {
                $user = User::findOrFail($request->user_id);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => 'guru', // SWITCH ROLE
                ]);
                if ($request->filled('password')) {
                    $user->update(['password' => bcrypt($request->password)]);
                }
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => 'guru', // CREATE AS GURU
                    'is_active' => true,
                ]);
            }

            // Create Guru Record
            \App\Models\Guru::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan_id' => $request->jabatan_id,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);
            
            return redirect()->route('admin.guru.index')->with('success', 'Data tersimpan sebagai Guru berdasarkan jabatan yang dipilih.');
        }

        // --- NORMAL KARYAWAN CREATION ---

        if ($request->has('user_id')) {
            $user = User::findOrFail($request->user_id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            if ($request->filled('password')) {
                $user->update([
                    'password' => bcrypt($request->password),
                ]);
            }
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'karyawan',
                'is_active' => true,
            ]);
        }

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

        // Check for role switch on Update
        $jabatan = null;
        if ($request->filled('jabatan_id')) {
            $jabatan = Jabatan::find($request->jabatan_id);
        }

        if ($jabatan && strtolower($jabatan->nama_jabatan) === 'guru') {
            // Move to Guru
            $user = $karyawan->user;
            
            // 1. Update User Role
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'guru',
            ]);
             if ($request->filled('password')) {
                $user->update(['password' => bcrypt($request->password)]);
            }

            // 2. Create Guru Record
            \App\Models\Guru::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan_id' => $request->jabatan_id,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            // 3. Delete Karyawan Record (Cleanup)
            $karyawan->delete();

            return redirect()->route('admin.guru.index')->with('success', 'Data dipindahkan ke Guru berdasarkan jabatan yang dipilih.');
        }

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
