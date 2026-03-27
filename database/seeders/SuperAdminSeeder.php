<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
      public function run(): void
      {
            User::firstOrCreate(
                  ['email' => 'admin@staffing.com'],
                  [
                        'name' => 'Super Admin',
                        'password' => Hash::make('password'),
                        'is_admin' => true,
                  ]
            );
      }
}
