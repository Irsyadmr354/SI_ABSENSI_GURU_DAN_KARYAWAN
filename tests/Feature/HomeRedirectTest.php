<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/')->assertRedirect('/login');
    }

    public function test_admin_is_redirected_to_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/')
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_guru_is_redirected_to_guru_dashboard(): void
    {
        $guru = User::factory()->create(['role' => 'guru']);

        $this->actingAs($guru)
            ->get('/')
            ->assertRedirect(route('guru.dashboard'));
    }

    public function test_karyawan_is_redirected_to_karyawan_dashboard(): void
    {
        $karyawan = User::factory()->create(['role' => 'karyawan']);

        $this->actingAs($karyawan)
            ->get('/')
            ->assertRedirect(route('karyawan.dashboard'));
    }
}
