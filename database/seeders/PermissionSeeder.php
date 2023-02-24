<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->letsGo();
    }

    protected $crudList = [
        'view',
        'create',
        'update',
        'delete',
    ];

    protected $permissionSlugs = [
       'roles',
       'permissions',
       'users',
//        'faculties',
//        'subjects',
//        'classes',
//        'sections',
//        'colleges',
//        'college_memberships',
//        'students',
//        'exams',
//        'question_papers',
//        'student_results',
//      'question-paper-attachment',
    ];

    public function letsGo()
    {
        foreach ($this->permissionSlugs as $slug) {
            foreach ($this->crudList as $index => $crud) {
                $result = DB::table('permissions')->insert([
                    array(
                        'name' => ucfirst($crud) .' '. ucfirst($slug),
                        'slug' => $crud .'-'. $slug,
                        'guard_name' => 'api',
                        'created_at' => now(),
                        'updated_at' => now()
                    ),
                ]);
                if (!$result) {
                    $this->command->info("Insert failed at record $index.");
                    return;
                }
            }
        }
        $this->command->info('Inserted ' . count($this->crudList) * count($this->permissionSlugs) . ' records.');
    }
}
