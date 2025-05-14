<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $adminRecords = [
            ['id'=>1,'regno'=>'s6068','title'=>'Mr.', 'surname'=>'Ojo','firstname'=>'Isaac','othername'=>'Mayowa',
                'mobile'=>'07030577951','image'=>'','status'=>1,'email'=>'mayorjo82@yahoo.com','password'=> Hash::make('123456'),'confirm'=>'yes']
            ];
         
        Admin::insert($adminRecords);
    }
}
