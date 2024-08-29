<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = $this->createMock(AuthService::class);
        $this->app->instance(AuthService::class, $this->authService);
    }

    public function testLoginView()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function testLoginAttemptSuccess()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $this->authService->expects($this->once())
            ->method('attemptLogin')
            ->with(['email' => $user->email, 'password' => 'password'])
            ->willReturn(true);

        $response = $this->post(route('login.attempt'), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Login successful');
    }

    public function testLoginAttemptFailure()
    {
        $this->authService->expects($this->once())
            ->method('attemptLogin')
            ->with(['email' => 'invalid@example.com', 'password' => 'password'])
            ->willReturn(false);

        $response = $this->post(route('login.attempt'), [
            'email' => 'invalid@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('error', 'Invalid credentials');
    }

    public function testRegisterView()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function testRegisterAttempt()
    {
        $this->authService->expects($this->once())
            ->method('createUser')
            ->with([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password'
            ]);

        $response = $this->post(route('register.attempt'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success', 'Registration successful, please log in.');
    }

    public function testLogout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->authService->expects($this->once())
            ->method('logout');

        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas('success', 'Logout successful');
    }
}
