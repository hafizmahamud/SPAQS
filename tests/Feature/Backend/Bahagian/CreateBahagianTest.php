<?php

namespace Tests\Feature\Backend\Bahagian;

use App\Domains\Auth\Events\Bahagian\BahagianCreated;
use App\Models\Pejabat;
use App\Models\Negeri;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Class CreateBahagianTest.
 */
class CreateBahagianTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_bahagian_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('login');
        $this->loginAsAdmin();

        Pejabat::create(
            [
                'id' => 19,
                'bahagian' => 'Klinik Kesihatan',
                'singkatan' => 'KK',
                'negeri_id' => 1,
            ]
        );

        $response = Pejabat::where('id', '19')
                ->first();
        $this->assertEquals($response->id, '19');
        $response = $this->get('/admin/auth/bahagian/1/create')
            ->assertSee('Bahagian');
    }

    /** @test */
    public function admin_can_create_new_bahagian()
    {
        Event::fake();

        $this->loginAsAdmin();

        $this->an_admin_can_access_the_create_bahagian_page();

        $this->assertDatabaseHas(
            'pejabat',
            [
                'bahagian' => 'Klinik Kesihatan',
            ]
        );
    }
}
