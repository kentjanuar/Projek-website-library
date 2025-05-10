<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_cannot_access_user_list_without_admin_role()
    {
        // Membuat pengguna biasa
        $user = User::create([
            'name' => 'User',
            'username' => 'username',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Address',
            'phone' => '1234567890',
        ]);
        
        // Login dengan user biasa
        $this->actingAs($user);
        
        // Coba akses halaman pengguna
        $response = $this->get('/dashboard/users');
        
        // Pastikan mendapat 403 karena user biasa tidak bisa mengaksesnya
        $response->assertStatus(403);
    }

    /** @test */
    public function it_can_access_user_list_with_admin_role()
    {
        // Membuat pengguna admin
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'adminuser',
            'email' => 'adminuser@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Admin Address',
            'phone' => '1234567890',
            'is_admin' => true,
        ]);
        
        // Login dengan user admin
        $this->actingAs($admin);
        
        // Akses halaman pengguna
        $response = $this->get('/dashboard/users');
        
        // Pastikan mendapat status 200
        $response->assertStatus(200)
                ->assertViewIs('dashboard.users.index')
                ->assertViewHas('users');
    }


    /** @test */
    // public function it_can_show_create_user_form()
    // {
    //     $user = User::create([
    //         'name' => 'Admin User',
    //         'username' => 'adminuser',
    //         'email' => 'adminuser@example.com',
    //         'password' => Hash::make('password'),
    //         'alamat' => 'Admin Address',
    //         'phone' => '1234567890',
    //     ]);

    //     // Login sebagai user
    //     $this->actingAs($user);

    //     $response = $this->get('/dashboard/users/create');

    //     $response->assertStatus(200)
    //              ->assertViewIs('dashboard.users.create');
    // }

    /** @test */
    // public function it_can_show_edit_user_form()
    // {
    //     $user = User::create([
    //         'name' => 'User to Edit',
    //         'username' => 'usertoedit',
    //         'email' => 'usertoedit@example.com',
    //         'password' => Hash::make('password'),
    //         'alamat' => 'Edit Address',
    //         'phone' => '1234567890',
    //     ]);

    //     // Login sebagai user
    //     $this->actingAs($user);

    //     $response = $this->get('/dashboard/users/'.$user->id.'/edit');

    //     $response->assertStatus(200)
    //              ->assertViewIs('dashboard.users.edit')
    //              ->assertViewHas('user', $user);
    // }

    /** @test */
    public function it_can_update_user_data()
    {

        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'adminuser',
            'email' => 'adminuser@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Admin Address',
            'phone' => '1234567890',
            'is_admin' => true,
        ]);

        $user = User::create([
            'name' => 'User to Update',
            'username' => 'usertoupdate',
            'email' => 'usertoupdate@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Update Address',
            'phone' => '1234567890',
        ]);

        // Login sebagai user
        $this->actingAs($admin);

        // Data baru untuk user yang ingin diupdate
        $updatedData = [
            'name' => 'Updated Name',
            'username' => 'updated_username',
            'email' => 'updated@example.com',
            'alamat' => 'Updated Address',
            'phone' => '0987654321',
        ];

        $response = $this->put('/dashboard/users/'.$user->id, $updatedData);

        $response->assertRedirect('/dashboard/users')
                 ->assertSessionHas('success', 'User has been updated.');

        $this->assertDatabaseHas('users', $updatedData);
    }

    /** @test */
    public function it_can_delete_user()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'username' => 'adminuser',
            'email' => 'adminuser@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Admin Address',
            'phone' => '1234567890',
            'is_admin' => true,
        ]);

        $user = User::create([
            'name' => 'User to Delete',
            'username' => 'usertodelete',
            'email' => 'usertodelete@example.com',
            'password' => Hash::make('password'),
            'alamat' => 'Delete Address',
            'phone' => '1234567890',
        ]);

        $this->actingAs($admin);

        $response = $this->delete('/dashboard/users/'.$user->id);

        $response->assertRedirect('/dashboard/users')
                 ->assertSessionHas('success', 'User has been deleted!');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
// public function it_cannot_update_user_with_invalid_data()
// {
//     $user = User::create([
//         'name' => 'User Invalid Data',
//         'username' => 'userinvaliddata',
//         'email' => 'userinvaliddata@example.com',
//         'password' => Hash::make('password'),
//         'alamat' => 'Invalid Address',
//         'phone' => '1234567890',
//     ]);

//     $this->actingAs($user);

//     // Data yang tidak valid
//     $invalidData = [
//         'name' => '',  // Nama tidak boleh kosong
//         'username' => '', // Username terlalu pendek
//         'email' => '', // Email tidak valid
//         'alamat' => '', // Alamat tidak boleh kosong
//         'phone' => '', // Nomor telepon terlalu pendek
//     ];

//     $response = $this->put('/dashboard/users/'.$user->id, $invalidData);

//     // Pastikan session mengandung error untuk setiap field yang invalid
//     $response->assertSessionHasErrors(['name', 'username', 'email', 'alamat', 'phone']);
// }

}
