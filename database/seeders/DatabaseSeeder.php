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
        $this->call(PermissionSeeder::class);

        $user = \App\Models\User::updateOrCreate(
            [
                'id'=>1
            ],
            [
            'id'=>1,
            'name' => 'Super Admin',
            'mobile'=>'9812345678',
            'email' => 'super@admin.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
        $user->createToken('WebAuthApp')->accessToken;
        // $user->assignRole()
        $user->roles()->attach(1);
        \App\Models\User::factory(100000)->create();

        // $user->assignRole('Super Admin');


        // DB::table('users')->factory(5000)->create();

    }
}
