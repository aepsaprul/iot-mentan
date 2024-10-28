<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $admin = User::create([
        'name' => 'adm',
        'email' => 'adm@email.com',
        'password' => bcrypt('12345678Ab$'),
        'password_show' => '12345678Ab$'
      ]);
      $admin->assignRole('adm');
    }
}
