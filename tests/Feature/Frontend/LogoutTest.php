<?php

namespace Tests\Feature\Frontend;

use App\Domains\Auth\Models\User;
use Tests\TestCase;
use App\Models\Log;
use Carbon\Carbon;

/**
 * Class LogoutTest.
 */
class LogoutTest extends TestCase
{
    /** @test */
    public function the_user_can_logout()
    {
        // $this->actingAs($user = User::factory()->create());

        // $Log = Log::factory()->create();
        // $this->assertDatabaseHas('activity_log', [
        //     'id' => 1000,
        // ]);


        // $this->assertAuthenticatedAs($user);

        // $this->post('/logout')->assertRedirect('/login');

        // $this->withoutExceptionHandling();
        // $this->assertFalse($this->isAuthenticated());
    }
}
