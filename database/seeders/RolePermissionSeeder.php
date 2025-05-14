<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perms = [ "view-my-profile",  "reset-password",
                "view-admin",   "create-admin",
                "import-admin", "assign-role",
                "view-role",    "create-role",
                "view-permission", "create-permission",
                "assign-permission", "manage-finances",
                "view-acad-settings", "view-session-terms",
                "manage-stud-course-reg-settings",
                "manage-result-upload-settings",
                "view-levels", "view-classroom",
                "create-classroom",  "view-subject",
                "create-subject",  "define-class-subject",
                "manage-subject-grade-settings",
                "view-question",  "import-question",
                "view-exam-schedule", "create-exam-schedule",
                "view-student",  "create-student",
                "import-student", "access-teacher-activities",
                "view-my-students", "upload-results",
                "view-student-result", "take-student-attendance",
                "view-my-assigned-courses"
            ];  $n=1;
            foreach($perms as $pm){
                $data[] = ['id'=>$n,'name'=>$pm,'guard_name'=>'admin'];
                $n++;
            }
            Permission::insert($data);

            $roles = [
                ['id'=>1, 'name'=>'Super-Admin','guard_name'=>'admin'],
                ['id'=>2, 'name'=>'Administrator','guard_name'=>'admin']
            ];

            Role::insert($roles);
    }
}
