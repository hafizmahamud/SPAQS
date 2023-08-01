<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Log;
use Illuminate\Support\Facades\Event;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Events\Alamat\AlamatCreated;
use App\Domains\Auth\Events\Alamat\AlamatUpdated;
use App\Domains\Auth\Events\Alamat\AlamatDeleted;
use App\Models\SenaraiAlamat;

class LogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_log_user_login()
    {
        //Create new row data as user login
        $Log = Log::factory()->create();
        //dd($Log);

        $this->withoutExceptionHandling();
        //Check the new row data in table activity_log
        $this->assertDatabaseHas('activity_log', [
            'id' => 1000,
        ]);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_log_user_logout()
    {
        // $user = User::factory()->create();

        // $this->actingAs($user)
        //     ->post('/logout')
        //     ->assertRedirect('/login');

        // $this->withoutExceptionHandling();

        // $this->assertFalse($this->isAuthenticated());

        $Log = Log::factory()->create();
        $this->assertDatabaseHas('activity_log', [
            'id' => 1000,
        ]);

        
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_log_user_create_tetapan()
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

        $Log = Log::factory()->create();
        $this->assertDatabaseHas('activity_log', [
            'id' => 1000,
        ]);

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_log_user_edit_tetapan()
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

        $Log = Log::factory()->create();
        $this->assertDatabaseHas('activity_log', [
            'id' => 1000,
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_log_user_delete_tetapan()
    {
        Event::fake();
        $this->loginAsAdmin();
        $alamat = SenaraiAlamat::factory()->create();
        SenaraiAlamat::where('id', $alamat->id)->delete();
        $this->assertDatabaseMissing('senarai_alamat', ['id' => $alamat->id]);

        $Log = Log::factory()->create();
        $this->assertDatabaseHas('activity_log', [
            'id' => 1000,
        ]);
    }

}
