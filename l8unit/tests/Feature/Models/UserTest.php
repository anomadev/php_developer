<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user()
    {
        User::factory()->create([
            'email' => 'anomadev@admin.com'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'anomadev@admin.com'
        ]);

        $this->assertDatabaseMissing('users', [
            'email' => 'no@admin.com'
        ]);
    }
}
