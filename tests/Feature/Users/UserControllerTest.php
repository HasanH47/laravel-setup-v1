<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function testIndex()
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
        $response->assertViewIs('users.index');
        $response->assertSee($this->user->name);
    }

    public function testCreate()
    {
        $response = $this->get(route('users.create'));

        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    public function testStore()
    {
        $response = $this->post(route('users.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'User created successfully');
        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }

    public function testShow()
    {
        $response = $this->get(route('users.show', $this->user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
        $response->assertSee($this->user->name);
    }

    public function testEdit()
    {
        $response = $this->get(route('users.edit', $this->user->id));

        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
        $response->assertSee($this->user->name);
    }

    public function testUpdate()
    {
        $response = $this->put(route('users.update', $this->user->id), [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'newpassword123',
        ]);

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'User updated successfully');
        $this->assertDatabaseHas('users', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
    }

    public function testDestroy()
    {
        $response = $this->delete(route('users.destroy', $this->user->id));

        $response->assertRedirect(route('users.index'));
        $response->assertSessionHas('success', 'User deleted successfully');
        $this->assertDatabaseMissing('users', [
            'id' => $this->user->id,
        ]);
    }
}
