<?php

namespace Tests\Feature\Backend\Alamat;

use App\Domains\Auth\Events\Alamat\AlamatCreated;
use App\Models\SenaraiAlamat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class CreateAlamatTest.
 */
class CreateAlamatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_alamat_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/auth/alamat/create');

        $response->assertOk();
    }

    /** @test */
    public function create_alamat_requires_validation()
    {
        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/alamat');

        $response->assertSessionHasErrors(['jenis_alamat', 'alamat']);
    }

    /** @test */
    public function admin_can_create_new_negeri()
    {
        Event::fake();

        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/alamat', [
            'jenis_alamat' => 'Rumah',
            'alamat' => 'Jalan Ukay Perdana, Ampang',
        ]);

        $this->assertDatabaseHas(
            'senarai_alamat',
            [
                'jenis_alamat' => 'Rumah',
                'alamat' => 'Jalan Ukay Perdana, Ampang',
            ]
        );

        $response->assertSessionHas(['flash_success' => __('Alamat telah berjaya ditambah')]);

        Event::assertDispatched(AlamatCreated::class);
    }
}
