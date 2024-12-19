<?php

namespace Tests\Feature;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * Тест отображения формы авторизации.
     */
    public function test_it_displays_login_form(): void
    {
        $response = $this->get(route('client.login.form'));

        $response->assertStatus(200);
        $response->assertViewIs('login.auth');
    }

    /**
     * Тест успешной авторизации клиента с корректными данными.
     */
    public function test_it_logs_in_client_with_valid_credentials(): void
    {
        $client = Client::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('client.login'), [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertTrue(Auth::guard('client')->check());
        $this->assertEquals(Auth::guard('client')->user()->id, $client->id);
    }

    /**
     * Тест неудачной авторизации клиента с некорректными данными.
     */
    public function test_it_fails_login_with_invalid_credentials(): void
    {
        $client = Client::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('client.login'), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('client.login.form')); // Убедитесь, что маршрут правильный
        $response->assertSessionHasErrors(['password']); // Изменено с 'email' на 'password'
        $this->assertFalse(Auth::guard('client')->check());
    }

    /**
     * Тест выхода клиента из системы.
     */
    public function test_it_logs_out_client(): void
    {
        $client = Client::factory()->create();
        Auth::guard('client')->login($client);

        $this->assertTrue(Auth::guard('client')->check());

        $response = $this->post(route('client.logout'));

        $response->assertRedirect('/');
        $this->assertFalse(Auth::guard('client')->check());
    }
}
