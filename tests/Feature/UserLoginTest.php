<?php
// Very basic testing using laravel's built-in 'feature' testing suite
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\UserTable;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;
    public function testLoginScenarios()
    {
        // Check the login page loads
        $response = $this->get('/');
        $response->assertOk();

        // Create and check the user exists
        $user = UserTable::factory()->create();
        $this->assertModelExists($user);

        // Check the example user has been saved to the database
        $this->assertDatabaseCount('testing.Users', 1);

        // Check the correct test user is in the testing DB
        $this->assertDatabaseHas('testing.Users',[
            'Username' => 'nameExample'
        ]);

        // Check the example user's database has been populated after refresh
        $this->assertDatabaseCount('testCo', 3);

        // Check the login method works
        $loginResponse = $this->actingAs($user)
            ->withSession(['un' => $user->Username])
            ->withSession(['pw' => 'password'])
            ->post('/login');
        echo session('redirectMsg');
        $loginResponse->assertOk();
    }
}