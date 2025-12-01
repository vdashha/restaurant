<?php

namespace Tests\Unit\Services\User;

use App\Models\Client;
use App\Services\User\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    //use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = app(AuthService::class);
    }

    /** @test */
    public function handle_attempts_login()
    {
        $client = Client::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('secret'),
        ]);

        $request = new Request([
            'email' => 'test@example.com',
            'password' => 'secret',
        ]);

        $result = $this->authService->handle($request);

        $this->assertTrue($result);
        $this->assertEquals(Auth::guard('client')->user()->id, $client->id);
    }

    /** @test */
    public function registration_creates_user_and_logs_in()
    {
        $request = new Request([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'phone' => '+375333333333',
        ]);

        $this->authService->registration($request);

        $this->assertDatabaseHas('clients', ['email' => 'john@example.com']);
        $this->assertTrue(Auth::guard('client')->check());
    }
}
