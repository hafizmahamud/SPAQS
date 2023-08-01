<?php

namespace Tests\Feature\Backend\Alamat;

use App\Domains\Auth\Events\Alamat\AlamatDeleted;
use App\Models\SenaraiAlamat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class DeleteAlamatTest.
 */
class DeleteAlamatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function alamat_boleh_dihapuskan()
    {
        Event::fake();
        $this->loginAsAdmin();
        $alamat = SenaraiAlamat::factory()->create();
        SenaraiAlamat::where('id', $alamat->id)->delete();
        $this->assertDatabaseMissing('senarai_alamat', ['id' => $alamat->id]);
    }
}
