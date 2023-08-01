<?php

namespace Tests\Feature\Backend\SubBidang;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\SubBidang;
use Modules\Sisdant\Models\Bidang;

/**
 * Class UpdateUserTest.
 */
class SubBidangTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_subidang()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        Bidang::create(
            [
            'kod' => '0101',
            'bidang' => 'Penerbitan',
            ]
        );

        SubBidang::create(
            [
            'kod' => '010102',
            'sub_bidang' => 'Bahan Bacaan',
            'bidang_id' => '4',
            ]
        );

        $response = SubBidang::where('id', '2')
                ->first();
        $this->assertEquals($response->id, '2');
    }

    /** @test */
    public function test_view_subidang()
    {
        $this->test_create_subidang();

        $response = $this->get('admin/auth/subBidang')
            ->assertSee('010102');
    }

    /** @test */
    public function test_update_subidang()
    {
        $this->test_create_subidang();
        $this->patch('admin/auth/subBidang', ['id' => '2'])
        ->assertSee('2');
    }

    /** @test */
    public function test_delete_subidang()
    {
        $this->test_create_subidang();
        SubBidang::where('id', '2')->delete();
        $this->assertDatabaseMissing('sub_bidang', ['id' => '2']);
    }
}
