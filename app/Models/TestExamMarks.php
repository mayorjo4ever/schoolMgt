<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestExamMarks extends Model
{
    use HasFactory;
    protected $fillable = ['id']; 
    
    public static function getSetings(){
       $mark_settings = TestExamMarks::select('ca_1','ca_2','exam')->first()->toArray();
       return $mark_settings;
    }
    
}

