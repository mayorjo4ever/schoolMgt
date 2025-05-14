<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentItem;

class PaymentItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $Records = [
            ['id'=>1,'name'=>'School Fees'],
            ['id'=>2,'name'=>'School Uniform'],
            ['id'=>3,'name'=>'Note Books'],
            ['id'=>4,'name'=>'Vest'],
            ['id'=>5,'name'=>'Transportation'],
            ];
         
        PaymentItem::insert($Records);
    }
}
