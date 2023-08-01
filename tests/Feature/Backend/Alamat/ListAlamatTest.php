<?php

namespace Tests\Feature\Backend\Alamat;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ReadAlamatTest.
 */
class ListAlamatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_alamat_index_page()
    {
        $this->loginAsAdmin();

        $this->get('/admin/auth/alamat')->assertOk();
    }

    /** @test */
    public function only_admin_can_view_alamat()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get('/admin/auth/alamat');

        $response->assertSessionHas('flash_danger', __('You do not have access to do that.'));
    }
}
