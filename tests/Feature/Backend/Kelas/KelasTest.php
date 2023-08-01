<?php

namespace Tests\Feature\Backend\Kelas;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\Kelas;

/**
 * Class UpdateUserTest.
 */
class KelasTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_kelas()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        Kelas::create(
            [
            'kod' => 'B',
            'kelas' => 'Bangunan',
            ]
        );

        $response = Kelas::where('id', '4')
                ->first();
        $this->assertEquals($response->id, '4');
    }

    /** @test */
    public function test_view_kelas()
    {
        $this->test_create_kelas();

        $response = $this->get('admin/auth/kelas')
            ->assertSee('B');
    }

    /** @test */
    public function test_update_kelas()
    {
        $this->test_create_kelas();
        $this->patch('admin/auth/kelas', ['id' => '4'])
        ->assertSee('4');
    }

    /** @test */
    public function test_delete_kelas()
    {
        $this->test_create_kelas();
        Kelas::where('id', '4')->delete();
        $this->assertDatabaseMissing('kelas', ['id' => '4']);
    }

}
