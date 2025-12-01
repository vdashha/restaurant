<?php

namespace Tests\Feature;

use App\Http\Controllers\ClientController;
use App\Http\Requests\User\RegistrationRequest;
use App\Models\User;
use App\Services\User\AuthService;
use App\Services\User\ProfileService;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class ClientsControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function show_login_form_saves_previous_url()
    {
        session()->flush();

        $authService = Mockery::mock(AuthService::class);
        $controller = new ClientController($authService);

        $this->withSession([]);
        //$this->get('/shop'); // создадим текущий урл

        // Мокаем route()
        $this->get(route('client.login.form'), [
            'HTTP_REFERER' => '/shop'
        ]);

        $this->assertStringEndsWith('/shop', session('url.intended'));
    }

    /** @test */
    public function show_registration_form_saves_url_and_returns_view()
    {
        $authService = Mockery::mock(AuthService::class);
        $authService->shouldReceive('save_url')->once();

        $this->app->instance(AuthService::class, $authService);

        $response = $this->get(route('client.signup'));

        $response->assertOk();
        $response->assertViewIs('login.signup');
    }

    /** @test */
    public function store_calls_registration_and_redirects()
    {
        $authService = Mockery::mock(\App\Services\User\AuthService::class);
        $authService->shouldReceive('registration')->once();

         //Вкладываем мок в контейнер
        $this->app->instance(\App\Services\User\AuthService::class, $authService);

        $this->withoutMiddleware();

        $response = $this->post(route('client.store'), [
            'name' => 'Test',
            'surname' => 'Test',
            'email' => 'test@email.com',
            'password' => 'test123456',
            'password_confirmation' => 'test123456',
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function login_success_redirects_to_home()
    {
        $authService = Mockery::mock(AuthService::class);
        $authService->shouldReceive('handle')->andReturn(true);

        $this->app->instance(AuthService::class, $authService);

        $this->withoutMiddleware();

        $response = $this->post(route('client.login'), [
            'email' => 'test@test.com',
            'password' => '123',
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function login_failure_returns_back_with_email_errors()
    {
        $authService = Mockery::mock(AuthService::class);
        $authService->shouldReceive('handle')->andReturn(false);

        $this->withoutMiddleware();

        $response = $this->post(route('client.login'), [
            'email' => 'test@test.com',
            'password' => 'wrong',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function logout_logs_out_and_redirects_back()
    {
        $guard = Mockery::mock();
        $guard->shouldReceive('logout')->once();

        Auth::shouldReceive('guard')->with('client')->andReturn($guard);

        $response = $this->get('/client/logout');

        $response->assertStatus(302);
    }

    /** @test */
    public function show_profile_returns_view_with_user()
    {
        $user = new User(['name' => 'John']);

        $guard = Mockery::mock();
        $guard->shouldReceive('user')->andReturn($user);

        Auth::shouldReceive('guard')->with('client')->andReturn($guard);

        $response = $this->get('/client/profile');

        $response->assertViewIs('user.profile');
        $response->assertViewHas('user', $user);
    }

    /** @test */
    public function update_profile_calls_service_and_returns_view()
    {
        $updatedUser = new User(['name' => 'Updated']);

        $profileService = Mockery::mock(ProfileService::class);
        $profileService->shouldReceive('update')->once()->andReturn($updatedUser);

        $this->app->instance(ProfileService::class, $profileService);

        $this->withoutMiddleware();

        $response = $this->post('/client/profile/update', [
            'name' => 'Updated',
        ]);

        $response->assertViewIs('user.profile');
        $response->assertViewHas('user', $updatedUser);
    }
}
