<?php

namespace Tests\Feature\Backend\User;

use App\Domains\Auth\Events\User\UserCreated;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Notifications\Frontend\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use App\Mail\UserRegistrationMailUser;
use Illuminate\Support\Facades\Mail;

/**
 * Class CreateUserTest.
 */
class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_user_page()
    {
        $this->loginAsAdmin();

        $response = $this->get('/admin/auth/user/create');

        $response->assertOk();
    }

    /** @test */
    public function create_user_requires_validation()
    {
        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/user');

        $response->assertSessionHasErrors(['type', 'name', 'email', 'password']);
    }

    /** @test */
    public function user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();

        User::factory()->create(['email' => 'john@example.com']);

        $response = $this->post('/admin/auth/user', [
            'email' => 'john@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function admin_can_create_new_user()
    {
        Event::fake();
        $this->withoutExceptionHandling();

        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/user', [
            'type' => User::TYPE_ADMIN,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            'roles' => [
                Role::whereName(config('boilerplate.access.role.admin'))->first()->id,
            ],
            'negeri_id' => '16',
            'section_id' => '1',
        ]);

        $this->assertDatabaseHas(
            'users',
            [
                'type' => User::TYPE_ADMIN,
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'negeri_id' => '16',
            ]
        );

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => Role::whereName(config('boilerplate.access.role.admin'))->first()->id,
            'model_type' => User::class,
            'model_id' => User::whereEmail('plisca.project@gmail.com')->first()->id,
        ]);

        $response->assertSessionHas(['flash_success' => __('The user was successfully created.')]);
       
        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function when_an_unconfirmed_user_is_created_a_notification_will_be_sent()
    {
        Notification::fake();

        $this->loginAsAdmin();

        $response = $this->post('/admin/auth/user', [
            'type' => User::TYPE_ADMIN,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            'send_confirmation_email' => '1',
            'roles' => [
                Role::whereName(config('boilerplate.access.role.admin'))->first()->id,
            ],
            'negeri_id' => '16',
            'section_id' => '1',
        ]);

        $response->assertSessionHas(['flash_success' => __('The user was successfully created.')]);

        $user = User::where('email', 'john@example.com')->first();

        Mail::to($user)->send(new UserRegistrationMailUser());
    }

    /** @test */
    public function only_admin_can_create_users()
    {
        $this->actingAs(User::factory()->admin()->create());

        $response = $this->get('/admin/auth/user/create');

        $response->assertSessionHas('flash_danger', __('You do not have access to do that.'));
    }
}
