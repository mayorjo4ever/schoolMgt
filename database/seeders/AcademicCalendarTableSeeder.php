<?php

namespace Database\Seeders;
use App\Models\AcademicCalendar;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicCalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['id'=>1,
            'current_session'=>'2023/2024',
            'current_term'=>'3.', 
            'term_begins'=>'2024-05-06'
            ]
            ];
         
        AcademicCalendar::insert($records);
    }
}
