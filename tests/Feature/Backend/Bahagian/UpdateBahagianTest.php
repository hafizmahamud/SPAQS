<?php

namespace Tests\Feature\Backend\Bahagian;

use App\Domains\Auth\Events\Bahagian\BahagianUpdated;
use App\Models\Pejabat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class UpdateBahagianTest.
 */
class UpdateBahagianTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_edit_bahagian_page()
    {
        $this->loginAsAdmin();

        $bahagian = Pejabat::factory()->create();

        $response = $this->get('/admin/auth/bahagian/'.$bahagian->id.'/edit');

        $response->assertOk();
    }

    /** @test */
    public function a_bahagian_can_be_updated()
    {
        Event::fake();

        $this->loginAsAdmin();

        $bahagian = Pejabat::factory()->create();

        $this->assertDatabaseMissing('pejabat', [
            'id' => $bahagian->id,
            'singkatan' => 'KK',
            'bahagian' => 'Klinik Kesihatan',
        ]);

        $this->patch("/admin/auth/bahagian/{$bahagian->id}", [
            'bahagian' => 'Klinik Kesihatan Kerajaan',
        ]);

        $this->assertDatabaseHas('pejabat', [
            'id' => $bahagian->id,
            'bahagian' => 'Klinik Kesihatan Kerajaan',
        ]);

        Event::assertDispatched(BahagianUpdated::class);
    }

}
