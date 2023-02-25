<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionSeeder::class);

        $user = \App\Models\User::create([
            'id'=>1,
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        // $user->assignRole()
        $user->roles()->attach(1);

        // $user->assignRole('Super Admin');


        // DB::table('users')->factory(5000)->create();



    }
}
