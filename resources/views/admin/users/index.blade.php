@extends('layouts.app')

@section('title', 'Manajemen User - SI Absensi')
@section('page_title', 'Otoritas Pengguna')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold text-zinc-900">Kontrol Akses</h1>
            <p class="text-sm text-zinc-500 mt-1">Mengelola akun sistem dan hak akses.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="inline-flex items-center justify-center px-4 py-2 bg-zinc-900 text-white rounded-xl text-sm font-medium hover:bg-black transition-all shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Registrasi User
        </a>
    </div>

    <!-- Data Table -->
    <div class="bg-white border border-zinc-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 border-b border-zinc-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Identitas</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-zinc-500 uppercase tracking-wider">Status Akun</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-zinc-500 uppercase tracking-wider">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse($users as $u)
                        <tr class="hover:bg-zinc-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-zinc-100 flex items-center justify-center text-zinc-600 font-bold text-sm border border-zinc-200">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-zinc-900 group-hover:text-black">{{ $u->name }}</p>
                                        <p class="text-xs text-zinc-500 font-mono">{{ $u->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-zinc-100 text-zinc-800 border border-zinc-200 uppercase">
                                    {{ $u->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($u->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-zinc-100 text-zinc-600 border border-zinc-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-zinc-400"></span>
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $u) }}" class="p-1.5 rounded-lg text-zinc-400 hover:text-zinc-700 hover:bg-zinc-100 transition-all" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.5 2.5 0 113.536 3.536L12 17.232l-3.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.users.reset-password', $u) }}" method="POST" class="inline-block" onsubmit="return confirm('Reset password ke default?')">
                                        @csrf
                                        <button type="submit" class="p-1.5 rounded-lg text-zinc-400 hover:text-orange-600 hover:bg-orange-50 transition-all" title="Reset Password">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded-lg text-zinc-400 hover:text-red-600 hover:bg-red-50 transition-all" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-12 h-12 bg-zinc-50 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                    </div>
                                    <p class="text-zinc-900 font-medium">Tidak ada data user</p>
                                    <p class="text-zinc-500 text-sm mt-1">Silakan tambahkan user baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-zinc-100 bg-zinc-50 flex items-center justify-between">
            {{ $users->links() }} 
        </div>
        @endif
    </div>
</div>
@endsection
