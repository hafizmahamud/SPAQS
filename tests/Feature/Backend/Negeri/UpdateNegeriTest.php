<?php

namespace Tests\Feature\Backend\Negeri;

use App\Domains\Auth\Events\Negeri\NegeriUpdated;
use App\Models\Negeri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class UpdateNegeriTest.
 */
class UpdateNegeriTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_edit_negeri_page()
    {
        $this->loginAsAdmin();

        $negeri = Negeri::factory()->create();

        $response = $this->get('/admin/auth/negeri/'.$negeri->id.'/edit');

        $response->assertOk();
    }

    /** @test */
    public function negeri_can_be_updated()
    {
        Event::fake();

        $this->loginAsAdmin();

        $negeri = Negeri::factory()->create();

        $this->assertDatabaseMissing('negeri', [
            'id' => $negeri->id,
            'singkatan' => 'MY',
            'negeri' => 'Malaysia',
            'alamat' => 'Kuala Lumpur, Malaysia',
        ]);

        $this->patch("/admin/auth/negeri/{$negeri->id}", [
            'negeri' => 'Malaysia',
            'alamat' => 'Kuala Lumpur, Malaysia',
        ]);

        $this->assertDatabaseHas('negeri', [
            'id' => $negeri->id,
            'negeri' => 'Malaysia',
            'alamat' => 'Kuala Lumpur, Malaysia',
        ]);

        Event::assertDispatched(NegeriUpdated::class);
    }

}
