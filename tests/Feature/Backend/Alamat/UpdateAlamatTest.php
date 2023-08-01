<?php

namespace Tests\Feature\Backend\Alamat;

use App\Domains\Auth\Events\Alamat\AlamatUpdated;
use App\Models\SenaraiAlamat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class UpdateAlamatTest.
 */
class UpdateAlamatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_edit_alamat_page()
    {
        $this->loginAsAdmin();

        $alamat = SenaraiAlamat::factory()->create();

        $response = $this->get('/admin/auth/alamat/'.$alamat->id.'/edit');

        $response->assertOk();
    }

    /** @test */
    public function alamat_can_be_updated()
    {
        Event::fake();

        $this->loginAsAdmin();

        $alamat = SenaraiAlamat::factory()->create();

        $this->assertDatabaseMissing('senarai_alamat', [
            'id' => $alamat->id,
            'jenis_alamat' => 'Rumah',
            'alamat' => 'Jalan Ukay Perdana, Ampang',
        ]);

        $this->patch("/admin/auth/alamat/{$alamat->id}", [
            'jenis_alamat' => 'Rumah Ayahanda',
            'alamat' => 'Jalan Ukay Perdana, Ampang Selangor',
        ]);

        $this->assertDatabaseHas('senarai_alamat', [
            'id' => $alamat->id,
            'jenis_alamat' => 'Rumah Ayahanda',
            'alamat' => 'Jalan Ukay Perdana, Ampang Selangor',
        ]);

        Event::assertDispatched(AlamatUpdated::class);
    }

}
