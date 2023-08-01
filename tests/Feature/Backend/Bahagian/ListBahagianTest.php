<?php

namespace Tests\Feature\Backend\Bahagian;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ReadBahagianTest.
 */
class ListBahagianTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_bahagian_index_page()
    {
        $this->loginAsAdmin();

        $this->get('/admin/auth/negeri/1/bahagian')->assertOk();
    }

    /** @test */
    public function only_admin_can_view_bahagian()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get('/admin/auth/negeri/1/bahagian');

        $response->assertSessionHas('flash_danger', __('You do not have access to do that.'));
    }
}
