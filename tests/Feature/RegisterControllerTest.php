<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Equivalence Partitioning (EP).
     */
    public function test_equivalence_partitioning_for_valid_input()
    {
        // Valid data in equivalence partitions
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@gmail.com',
            'alamat' => '123 Main St',
            'phone' => '081234567890',
            'password' => 'password123'
        ];

        $response = $this->post('/register', $data);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Your account has been created.');

        // Assert data is stored in the database
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@gmail.com',
            'username' => 'johndoe'
        ]);
    }

    /**
     * Test Equivalence Partitioning for invalid input.
     */
    public function test_equivalence_partitioning_for_invalid_input()
    {
        // Invalid email and phone
        $data = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'invalid-email', // Invalid email
            'alamat' => '123 Main St',
            'phone' => '123', // Invalid phone
            'password' => 'password123'
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors(['email', 'phone']);
    }

    /**
     * Test Boundary Value Analysis (BVA).
     */
    public function test_minimum_boundary_for_phone_number()
    {
        $dataMinBoundary = [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@gmail.com',
            'alamat' => '123 Main St',
            'phone' => '1234567890', // 10 digits (min valid)
            'password' => 'password123'
        ];

        $response = $this->post('/register', $dataMinBoundary);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', ['phone' => '1234567890']);
    }

    /**
     * Test maximum boundary for phone number.
     */
    public function test_maximum_boundary_for_phone_number()
    {
        $dataMaxBoundary = [
            'name' => 'John Doe',
            'username' => 'johndoe2',
            'email' => 'johndoe2@gmail.com',
            'alamat' => '123 Main St',
            'phone' => '123456789012345', // 15 digits (max valid)
            'password' => 'password123'
        ];

        $response = $this->post('/register', $dataMaxBoundary);
        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', ['phone' => '123456789012345']);
    }

    /**
     * Test below minimum boundary for phone number.
     */
    public function test_below_minimum_boundary_for_phone_number()
    {
        $dataBelowMinBoundary = [
            'name' => 'John Doe3',
            'username' => 'johndoe3',
            'email' => 'johndoe3@gmail.com',
            'alamat' => '123 Main St',
            'phone' => '123456789', // 9 digits (below min valid)
            'password' => 'password123'
        ];

        $response = $this->post('/register', $dataBelowMinBoundary);
        $response->assertSessionHasErrors(['phone']);
    }

    /**
     * Test above maximum boundary for phone number.
     */
    public function test_above_maximum_boundary_for_phone_number()
    {
        $dataAboveMaxBoundary = [
            'name' => 'John Doe',
            'username' => 'johndoe4',
            'email' => 'johndoe4@gmail.com',
            'alamat' => '123 Main St',
            'phone' => '1234567890123456', // 16 digits (above max valid)
            'password' => 'password123'
        ];

        $response = $this->post('/register', $dataAboveMaxBoundary);
        $response->assertSessionHasErrors(['phone']);
    }
}
