<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Records = [
            ['id'=>1,'name'=>'1st','is_current'=>0],
            ['id'=>2,'name'=>'2nd','is_current'=>1],
            ['id'=>3,'name'=>'3rd','is_current'=>0]        
            ];
         
        Term::insert($Records);
    }
}
