<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('roles')->insert([
        [
            'id'=>1,
            'name'=>'Super Admin',
            'slug'=>'super-admin',
            'guard_name'=>'api',
        ],
        [
            'id'=>2,
            'name'=>'Customer',
            'slug'=>'customer',
            'guard_name'=>'api',
        ],

       ]);


    }
}
