<?php

namespace Tests\Feature\Backend\Pengkhususan;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\Pengkhususan;
use Modules\Sisdant\Models\Kelas;

/**
 * Class UpdateUserTest.
 */
class PengkhususanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_pengkhususan()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        Kelas::create(
            [
                'kod' => 'B',
                'kelas' => 'Bangunan',
            ]
        );

        Pengkhususan::create(
            [
                'kod' => 'B01',
                'pengkhususan' => 'IBS: Sistem Konkrit Pasang siap',
                'kelas_id' => '4',
            ]
        );

        $response = Pengkhususan::where('id', '2')
                ->first();
        $this->assertEquals($response->id, '2');
    }

    /** @test */
    public function test_view_pengkhususan()
    {
        $this->test_create_pengkhususan();

        $response = $this->get('admin/auth/pengkhususan')
            ->assertSee('010102');
    }

    /** @test */
    public function test_update_pengkhususan()
    {
        $this->test_create_pengkhususan();
        $this->patch('admin/auth/pengkhususan', ['id' => '2'])
        ->assertSee('2');
    }

    /** @test */
    public function test_delete_pengkhususan()
    {
        $this->test_create_pengkhususan();
        Pengkhususan::where('id', '2')->delete();
        $this->assertDatabaseMissing('pengkhususan', ['id' => '2']);
    }
}
