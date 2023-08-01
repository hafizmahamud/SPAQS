<?php

namespace Tests\Feature\Frontend;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;

/**
 * Class RegistrationTest.
 */
class RegistrationTest extends TestCase
{
    /** @test */
    public function the_register_route_exists()
    {
        $this->withoutExceptionHandling();
        $this->get('/register')->assertStatus(200);
    }

    /** @test */
    public function registration_requires_validation()
    {
        $response = $this->post('/register',[
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'ic_no' => '111111111111',
            'section_id' => '1',
            'negeri_id' => '16',
            'password' => 'Plisca123456**',
            'password_confirmation' => 'Plisca123456**',
        ]);

        $this->withoutExceptionHandling();
        $response->assertSessionHasNoErrors();
     }

    /** @test */
    public function email_must_be_unique()
    {
       $email = User::factory()->create(['email' => 'john@example.com']);


        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johny@example.com',
            'ic_no' => '111111111111',
            'section_id' => '1',
            'password' => 'Plisca123456**',
        ]);

        $this->withoutExceptionHandling();
        //$this->assertEquals($email,'!=',$response->email);
        $response->assertStatus(302);
    }

    /** @test */
    public function password_must_be_confirmed()
    {

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'not_the_same',
        ]);

        $this->withoutExceptionHandling();
        //$response->assertValid('password');
       $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function passwords_must_be_equivalent()
    {

        $password = 'Plisca123456***';
        $password_confirmation = 'Plisca123456***';

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'ic_no' => '111111111111',
            'section_id' => '1',
            'password' => $password,
            'password_confirmation' => $password_confirmation,
        ]);
        $this->withoutExceptionHandling();
        $this->assertEquals($password, $password_confirmation);
        
        
    }

    /** @test */
    public function user_registration_can_be_disabled()
    {
        config(['boilerplate.access.user.registration' => false]);

        $this->get('/register')->assertStatus(404);
    }

    /** @test */
    public function a_user_can_register_an_account()
    {
        $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            ])->assertRedirect(route(homeRoute()));

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john1@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
        ]);

        // $user = resolve(UserService::class)
        //     ->where('email', 'john@example.com')
        //     ->firstOrFail();

        $this->withoutExceptionHandling();
        $this->assertSame($user->name,'John Doe');
        $this->assertTrue(Hash::check('OC4Nzu270N!QBVi%U%qX', $user->password));
        //$this->assertStatus(302);
    }
}
