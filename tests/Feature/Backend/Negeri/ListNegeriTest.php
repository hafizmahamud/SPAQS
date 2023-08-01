<?php

namespace Tests\Feature\Backend\Negeri;

use App\Domains\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ReadNegeriTest.
 */
class ListNegeriTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_negeri_index_page()
    {
        $this->loginAsAdmin();

        $this->get('/admin/auth/negeri')->assertOk();
    }

    /** @test */
    public function only_admin_can_view_negeri()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get('/admin/auth/negeri');

        $response->assertSessionHas('flash_danger', __('You do not have access to do that.'));
    }
}
