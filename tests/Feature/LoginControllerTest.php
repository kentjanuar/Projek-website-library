<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a user manually (using registration logic).
     */
    private function createUser($email, $password)
    {
        User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'alamat' => 'Jl. Raya No. 1',
            'phone' => '081234567890',
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }

    /**
     * Test valid login credentials (EP).
     */
    public function test_valid_login_credentials()
    {
        // Create user manually
        $this->createUser('valid@gmail.com', 'validpassword');

        // Test login with valid credentials
        $response = $this->post('/login', [
            'email' => 'valid@gmail.com',
            'password' => 'validpassword',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    /**
     * Test invalid email (EP).
     */
    public function test_invalid_email()
    {
        // Create user manually
        $this->createUser('valid@gmail.com', 'validpassword');

        // Test login with an invalid email
        $response = $this->post('/login', [
            'email' => 'invalid@example.com', // Email not registered
            'password' => 'validpassword',
        ]);

        $response->assertSessionHas('loginError', 'Login failed!');
        $this->assertGuest();
    }

    /**
     * Test invalid password (EP).
     */
    public function test_invalid_password()
    {
        // Create user manually
        $this->createUser('valid@gmail.com', 'validpassword');

        // Test login with an incorrect password
        $response = $this->post('/login', [
            'email' => 'valid@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHas('loginError', 'Login failed!');
        $this->assertGuest();
    }

    /**
     * Test empty email and password (EP).
     */
    public function test_empty_email_and_password()
    {
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
        $this->assertGuest();
    }

    
    /**
     * Test minimum boundary for password length (BVA).
     */
    public function test_minimum_boundary_for_password()
    {

        // Boundary at minimum length
        $this->createUser('valid@gmail.com', 'abcde'); // 5 characters (valid)

        $response = $this->post('/login', [
            'email' => 'valid@gmail.com',
            'password' => 'abcde',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    /**
     * Test maximum boundary for password length (BVA).
     */
    public function test_maximum_boundary_for_password()
    {

        // Boundary at maximum length
        $validPassword = str_repeat('a', 30); // 30 characters (valid)

        $this->createUser('valid@gmail.com', $validPassword);

        $response = $this->post('/login', [
            'email' => 'valid@gmail.com',
            'password' => $validPassword,
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }


    /**
     * Test password length below minimum (3 characters).
     */
    public function test_password_length_below_minimum()
    {
        // Coba login dengan password 3 karakter
        $response = $this->post('/login', [
            'email' => 'valid@gmail.com',
            'password' => 'abc', // 3 characters (invalid)
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    /**
     * Test password length above maximum (31 characters).
     */
    public function test_password_length_above_maximum()
    {
        // Coba login dengan password 31 karakter
        $longPassword = str_repeat('a', 31); // 31 characters (invalid)

        $response = $this->post('/login', [
            'email' => 'valid@gmail.com',
            'password' => $longPassword,
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

}
