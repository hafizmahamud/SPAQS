<?php

namespace Tests\Feature\Backend\BayarKepada;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Modules\Sisdant\Models\BayarKepada;

/**
 * Class UpdateUserTest.
 */
class BayarKepadaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_create_bayaran()
    {
        $response = $this->get('login');
        $this->loginAsAdmin();

        $this->bayar = BayarKepada::create(
            [
            'nama' => 'Syarikat A',
            ]
        );

        $response = BayarKepada::where('id', $this->bayar->id)
                ->first();

        $this->assertEquals($response->nama, 'Syarikat A');
    }

    /** @test */
    public function test_view_bayaran()
    {
        $this->test_create_bayaran();

        $response = $this->get('admin/auth/bayaran')
            ->assertSee('Syarikat A');
    }

    /** @test */
    public function test_update_bayaran()
    {
        $this->test_create_bayaran();
        // dd($this);
        $this->patch('admin/auth/bayaran', ['id' => $this->bayar->id])
        ->assertSee('4');
    }

    /** @test */
    public function test_delete_bayaran()
    {
        $this->test_create_bayaran();
        BayarKepada::where('id', '5')->delete();
        $this->assertDatabaseMissing('bayar_kepada', ['id' => $this->bayar->id]);
    }

}
