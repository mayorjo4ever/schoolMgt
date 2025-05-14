<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $Records = [
            ['id'=>1,'name'=>'JSS1'],
            ['id'=>2,'name'=>'JSS2'],
            ['id'=>3,'name'=>'JSS3'],
            ['id'=>4,'name'=>'SS1'],
            ['id'=>5,'name'=>'SS2'],
            ['id'=>6,'name'=>'SS3']
            ];

        Level::insert($Records);
    }
}

array_combine();
