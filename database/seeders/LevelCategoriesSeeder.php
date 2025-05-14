<?php

namespace Database\Seeders;

use App\Models\LevelCategory;
use Illuminate\Database\Seeder;

class LevelCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $Records = [
            ['id'=>1,'name'=>'General'],
            ['id'=>2,'name'=>'Art'],
            ['id'=>3,'name'=>'Commercial'],
            ['id'=>4,'name'=>'Science']    
            ];
         
        LevelCategory::insert($Records);
    }
}
