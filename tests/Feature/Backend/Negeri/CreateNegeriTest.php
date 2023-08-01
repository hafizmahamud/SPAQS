<?php

namespace Tests\Feature\Backend\Negeri;

use App\Domains\Auth\Events\Negeri\NegeriCreated;
use App\Models\Negeri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class CreateNegeriTest.
 */
class CreateNegeriTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_negeri_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/auth/negeri/create');

        $response->assertOk();
    }

    /** @test */
    public function create_negeri_requires_validation()
    {
        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/negeri');

        $response->assertSessionHasErrors(['singkatan', 'negeri', 'alamat']);
    }

    /** @test */
    public function admin_can_create_new_negeri()
    {
        Event::fake();

        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/negeri', [
            'negeri' => 'Malaysia',
            'singkatan' => 'MY',
            'alamat' => 'Kuala Lumpur, Malaysia',
        ]);

        $this->assertDatabaseHas(
            'negeri',
            [
                'negeri' => 'Malaysia',
                'singkatan' => 'MY',
                'alamat' => 'Kuala Lumpur, Malaysia',
            ]
        );

        $response->assertSessionHas(['flash_success' => __('Pejabat JPS telah berjaya ditambah')]);

        Event::assertDispatched(NegeriCreated::class);
    }
}
