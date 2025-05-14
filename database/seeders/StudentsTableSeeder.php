<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $Records = [
            ['id'=>1,'regno'=>'07/55ec149','surname'=>'Adebisi',
              'firstname'=>'Daniel','gender'=>'male','password'=> Hash::make('123456')]
            ];
         
            Student::insert($Records);
    }
}
