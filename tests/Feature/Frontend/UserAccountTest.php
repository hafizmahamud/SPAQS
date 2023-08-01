<?php

namespace Tests\Feature\Frontend;

use App\Domains\Auth\Models\User;
use Tests\TestCase;

/**
 * Class UserAccountTest.
 */
class UserAccountTest extends TestCase
{
    /** @test */
    public function only_authenticated_users_can_access_their_account()
    {
        $this->get('/account')->assertRedirect('/login');

        $this->actingAs(User::factory()->create());

        $this->get('/account');
    }

    /** @test */
    public function profile_update_requires_validation()
    {

        $this->actingAs(User::factory()->create());

        $response = $this->patch('/profile/update');

        $response->assertSessionHasErrors(['nama']);

        $response = $this->patch('/profile/update');

        $response->assertSessionHasErrors('nama');
    }

    /** @test */
    public function a_user_can_update_their_profile()
    {
        $response = $this->get('/account');
        config(['boilerplate.access.user.change_email' => false]);

        $user = User::factory()->create([
            'name' => 'Jane Doe',
            'ic_no' => '1111111111',
            'negeri_id' => '16',
            'section_id' => '1',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Jane Doe',
            'ic_no' => '1111111111',
            'negeri_id' => '16',
            'section_id' => '1',
        ]);

        $response = User::where('id', $user->id)
        ->update([
            'name' => 'John Doe',
            'ic_no' => '1111111111',
            'negeri_id' => '17',
            'section_id' => '1',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John Doe',
            'ic_no' => '1111111111',
            'negeri_id' => '17',
            'section_id' => '1',
        ]);
    }

}
