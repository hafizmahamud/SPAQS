<?php

namespace Tests\Feature\Backend\Bahagian;

use App\Domains\Auth\Events\Bahagian\BahagianDeleted;
use App\Models\Pejabat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class DeleteBahagianTest.
 */
class DeleteBahagianTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function bahagian_boleh_dihapuskan()
    {
        Event::fake();
        $this->loginAsAdmin();
        $bahagian = Pejabat::create(
            [
                'bahagian' => 'Klinik Kesihatan',
                'singkatan' => 'KK',
                'negeri_id' => 1,
            ]
        );
        Pejabat::where('id', $bahagian->id)->delete();
        $this->assertDatabaseMissing('pejabat', ['id' => $bahagian->id]);
    }
}
