<?php

namespace Tests\Feature\Backend\Negeri;

use App\Domains\Auth\Events\Negeri\NegeriDeleted;
use App\Models\Negeri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class DeleteNegeriTest.
 */
class DeleteNegeriTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function negeri_boleh_dihapuskan()
    {
        Event::fake();
        $this->loginAsAdmin();
        $negeri = Negeri::factory()->create();
        Negeri::where('id', $negeri->id)->delete();
        $this->assertDatabaseMissing('negeri', ['id' => $negeri->id]);
    }
}
