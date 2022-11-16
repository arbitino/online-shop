<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Listeners\SendEmailNewUserListener;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_login_page_success(): void
    {
        $this->get(action([SignInController::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.login');
    }

    /**
     * @test
     * @return void
     */
    public function it_register_page_success(): void
    {
        $this->get(action([SignUpController::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.register');
    }

    /**
     * @test
     * @return void
     */
    public function it_forgot_page_success(): void
    {
        $this->get(action([ForgotPassword::class, 'page']))
            ->assertOk()
            ->assertViewIs('auth.forgot');
    }

    /**
     * @test
     * @return void
     */
    public function is_login_in_success(): void
    {
        $password = '1234qwer12qw34er';

        $user = UserFactory::new()->create([
            'email' => 'testing@frenckee.com',
            'password' => bcrypt($password)
        ]);

        $request = LoginRequest::factory()->create([
            'email' => $user->email,
            'password' => $user->password
        ]);

        $response = $this->post(
            action([SignInController::class, 'handle']),
            $request
        );

        $response->assertValid()
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    /**
     * @test
     * @return void
     */
    public function it_logout_success(): void
    {
        $user = UserFactory::new()->create([
            'email' => 'testing@frenckee.com'
        ]);

        $this->actingAs($user)
            ->delete(action([SignInController::class, 'logout']));

        $this->assertGuest();
    }

    /**
     * @test
     * @return void
     */
    public function it_register_success(): void
    {
        Notification::fake();
        Event::fake();

        $request = RegisterRequest::factory()->create([
            'email' => 'testing@frenckee.com',
            'password' => '1234qwer12qw34er',
            'password_confirmation' => '1234qwer12qw34er',
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => $request['email']
        ]);

        $response = $this->post(
            action([SignUpController::class, 'handle']),
            $request
        );

        $this->assertDatabaseHas('users', [
            'email' => $request['email']
        ]);

        $user = User::query()
            ->where('email', $request['email'])
            ->first();

        Event::assertDispatched(Registered::class);
        Event::assertListening(Registered::class, SendEmailNewUserListener::class);

        $event = new Registered($user);
        $listener = new SendEmailNewUserListener();
        $listener->handle($event);

        Notification::assertSentTo($user);

        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('home'));
    }
}
