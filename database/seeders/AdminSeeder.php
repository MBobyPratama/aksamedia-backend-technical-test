<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Admin::create([
      'name' => 'Administrator',
      'username' => 'admin',
      'phone' => '08123456789',
      'email' => 'admin@aksamedia.com',
      'password' => Hash::make('pastibisa'),
    ]);
  }
}
