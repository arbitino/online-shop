<?php

namespace Auth\Actions;

use App\Http\Requests\RegisterRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterNewUserActionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_success__user_create(): void
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'test@test2.com'
        ]);

        $action = app(RegisterNewUserContract::class);

        $action(
            NewUserDTO::fromRequest(
                new RegisterRequest([
                    'name' => 'test',
                    'email' => 'test@test2.com',
                    'password' => '1234qwer'
                ])
            )
        );

        $this->assertDatabaseHas('users', [
            'email' => 'test@test2.com'
        ]);
    }
}
