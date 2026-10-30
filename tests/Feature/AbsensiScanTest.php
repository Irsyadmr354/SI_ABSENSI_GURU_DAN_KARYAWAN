<?php

namespace Tests\Feature;

use App\Models\Absensi;
use App\Models\JamKerja;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class AbsensiScanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();

        Carbon::setTestNow(Carbon::parse('2026-10-30 08:10:00', 'Asia/Jakarta'));

        JamKerja::create([
            'nama' => 'Shift Pagi',
            'jam_masuk' => '08:00:00',
            'jam_pulang' => '17:00:00',
            'toleransi_keterlambatan' => 15,
            'is_active' => true,
        ]);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }

    private function guru(): User
    {
        return User::factory()->create(['role' => 'guru']);
    }

    private function issueToken(string $token, User $user): string
    {
        Cache::put('attendance_qr_' . $token, ['user_id' => $user->id], 60);

        return $token;
    }

    public function test_check_in_on_time_records_attendance(): void
    {
        $user = $this->guru();

        $response = $this->actingAs($user)
            ->get('/absensi/scan-process/' . $this->issueToken('token-masuk', $user));

        $response->assertOk()->assertSee('Berhasil Absen!')->assertSee('Masuk');

        $this->assertDatabaseHas('absensi', [
            'user_id' => $user->id,
            'tanggal' => '2026-10-30 00:00:00',
            'jam_masuk' => '08:10:00',
            'status' => 'hadir',
            'terlambat' => null,
        ]);
    }

    public function test_late_check_in_records_minutes_late(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-10-30 08:45:00', 'Asia/Jakarta'));
        $user = $this->guru();

        $this->actingAs($user)
            ->get('/absensi/scan-process/' . $this->issueToken('token-telat', $user))
            ->assertOk()
            ->assertSee('Terlambat');

        $absensi = Absensi::where('user_id', $user->id)->firstOrFail();
        $this->assertSame(45, $absensi->terlambat);
    }

    public function test_second_scan_checks_out(): void
    {
        $user = $this->guru();

        $this->actingAs($user)
            ->get('/absensi/scan-process/' . $this->issueToken('token-masuk', $user))
            ->assertOk();

        Carbon::setTestNow(Carbon::parse('2026-10-30 16:30:00', 'Asia/Jakarta'));

        $this->actingAs($user)
            ->get('/absensi/scan-process/' . $this->issueToken('token-pulang', $user))
            ->assertOk()
            ->assertSee('Pulang');

        $this->assertDatabaseHas('absensi', [
            'user_id' => $user->id,
            'jam_pulang' => '16:30:00',
        ]);
    }

    public function test_token_can_only_be_used_once(): void
    {
        $user = $this->guru();

        $this->actingAs($user)
            ->get('/absensi/scan-process/' . $this->issueToken('token-sekali', $user))
            ->assertOk();

        $this->actingAs($user)
            ->get('/absensi/scan-process/token-sekali')
            ->assertOk()
            ->assertSee('Kadaluarsa');
    }

    public function test_token_belongs_to_another_user_is_rejected(): void
    {
        $owner = $this->guru();
        $other = $this->guru();

        $this->actingAs($other)
            ->get('/absensi/scan-process/' . $this->issueToken('token-orang-lain', $owner))
            ->assertOk()
            ->assertSee('Akun Tidak Cocok');

        $this->assertDatabaseCount('absensi', 0);
    }

    public function test_scan_before_window_is_rejected(): void
    {
        Carbon::setTestNow(Carbon::parse('2026-10-30 05:00:00', 'Asia/Jakarta'));
        $user = $this->guru();

        $this->actingAs($user)
            ->get('/absensi/scan-process/' . $this->issueToken('token-pagi', $user))
            ->assertOk()
            ->assertSee('Belum waktunya');

        $this->assertDatabaseCount('absensi', 0);
    }
}
