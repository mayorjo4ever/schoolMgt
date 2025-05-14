<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class SubjectGrade extends Model
{
    use HasFactory;
    
    
    public static function get_grade($score) : array {
        $grade = ""; $remarks = ""; 
        ## $marks = SubjectGrade::get()->toArray();          
        ### $marks transfered to session for less database query         
        $marks = Session::get('marks'); 
        
        foreach($marks as $mark):
            if($score >=$mark['mark_from'] && $score <=$mark['mark_to']):
                $grade = $mark['grade'];  
                $remarks = $mark['remarks'];  
            endif;
        endforeach;
        return [$grade, $remarks];
    }
}
