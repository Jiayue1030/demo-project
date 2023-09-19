<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moonshine_user_roles')->insert([
            'id' => 2,
            'name' => 'Author'
        ]);

        Article::factory(10)->create();

        DB::table('settings')->insert([
            'id' => 1,
            'email' => fake()->email(),
            'phone' => fake()->e164PhoneNumber(),
            'copyright' => now()->year
        ]);

        $admin = User::create([
            'fullname' => 'Admin',
            'email'    => 'admin@admin.com',
            'status'   => 'active',
            'superadmin' => 1,
            'password' => Hash::make('password')
        ]);
        $admin->setPassword('password');

        $statement = "ALTER TABLE staff AUTO_INCREMENT = 100;";
    }
}
