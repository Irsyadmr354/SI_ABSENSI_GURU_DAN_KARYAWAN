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
        $pendingUsers = User::where('role', 'guru')
            ->where('is_active', true)
            ->doesntHave('guru')
            ->get();
        return view('admin.guru.index', compact('guru', 'pendingUsers'));
    }

    public function create(Request $request)
    {
        $jabatan = Jabatan::all();
        $user = null;
        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
        }
        return view('admin.guru.create', compact('jabatan', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email' . ($request->has('user_id') ? '' : '|unique:users,email'),
            'password' => $request->has('user_id') ? 'nullable|min:8' : 'required|min:8',
            'nip' => 'required|string|unique:guru,nip',
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

        // If Jabatan implies 'karyawan', we switch to creating a Karyawan record
        if ($jabatan && strtolower($jabatan->nama_jabatan) === 'karyawan') {
            
            // Delete incomplete guru if exists (from pending state) but wait, 
            // if we are here, we are creating. If user_id existed, they were 'guru'.
            // We need to update their role to 'karyawan'.
            
            if ($request->has('user_id')) {
                $user = User::findOrFail($request->user_id);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role' => 'karyawan', // SWITCH ROLE
                ]);
                if ($request->filled('password')) {
                    $user->update(['password' => bcrypt($request->password)]);
                }
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role' => 'karyawan', // CREATE AS KARYAWAN
                    'is_active' => true,
                ]);
            }

            // Create Karyawan Record
            \App\Models\Karyawan::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan_id' => $request->jabatan_id,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);
            
            // Ensure no Guru record exists (if switching from pending guru)
            // Doesnt apply here as we are creating, but if we had a partial record? 
            // The constraint is user_id.
            
            return redirect()->route('admin.karyawan.index')->with('success', 'Data tersimpan sebagai Karyawan berdasarkan jabatan yang dipilih.');
        }

        // --- NORMAL GURU CREATION ---

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
                'role' => 'guru',
                'is_active' => true,
            ]);
        }

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

        // Check for role switch on Update
        $jabatan = null;
        if ($request->filled('jabatan_id')) {
            $jabatan = Jabatan::find($request->jabatan_id);
        }

        if ($jabatan && strtolower($jabatan->nama_jabatan) === 'karyawan') {
            // Move to Karyawan
            $user = $guru->user;
            
            // 1. Update User Role
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'karyawan',
            ]);
             if ($request->filled('password')) {
                $user->update(['password' => bcrypt($request->password)]);
            }

            // 2. Create Karyawan Record
            \App\Models\Karyawan::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jabatan_id' => $request->jabatan_id,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            // 3. Delete Guru Record (Cleanup)
            $guru->delete();

            return redirect()->route('admin.karyawan.index')->with('success', 'Data dipindahkan ke Karyawan berdasarkan jabatan yang dipilih.');
        }

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
