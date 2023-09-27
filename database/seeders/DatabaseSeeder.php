<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'superadmin' => 1,
            'user_type' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
            'moonshine_user_role_id' => 1,
        ]);
        
        DB::table('user_roles')->insert(['id' => 1,'name' => 'Admin']);
        DB::table('user_roles')->insert(['id' => 2,'name' => 'Client']);
        DB::table('user_roles')->insert(['id' => 3,'name' => 'Staff']);

        DB::table('moonshine_user_roles')->insert(['id' => 2,'name' => 'Client']);
        DB::table('moonshine_user_roles')->insert(['id' => 3,'name' => 'Staff']);

        DB::table('settings')->insert([
            'id' => 1,
            'email' => fake()->email(),
            'phone' => fake()->e164PhoneNumber(),
            'copyright' => now()->year
        ]);
    }
}
