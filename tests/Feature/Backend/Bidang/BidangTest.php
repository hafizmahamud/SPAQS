<?php

namespace Tests\Feature\Backend\Bidang;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\Bidang;

/**
 * Class UpdateUserTest.
 */
class BidangTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_bidang()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        Bidang::create(
            [
            'kod' => '0101',
            'bidang' => 'Penerbitan',
            ]
        );

        $response = Bidang::where('id', '4')
                ->first();
        $this->assertEquals($response->id, '4');
    }

    /** @test */
    public function test_view_bidang()
    {
        $this->test_create_bidang();

        $response = $this->get('admin/auth/bidang')
            ->assertSee('0101');
    }

    /** @test */
    public function test_update_bidang()
    {
        $this->test_create_bidang();
        $this->patch('admin/auth/bidang', ['id' => '4'])
        ->assertSee('4');
    }

    /** @test */
    public function test_delete_bidang()
    {
        $this->test_create_bidang();
        Bidang::where('id', '4')->delete();
        $this->assertDatabaseMissing('bidang', ['id' => '4']);
    }

}
