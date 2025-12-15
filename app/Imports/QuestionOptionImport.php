<?php

namespace App\Imports;
##use PhpParser\Builder\Class;


use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;

class QuestionOptionImport implements ToCollection
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
      //  print "<pre>";
      //  print " subject id = ". Session::get('subject_id');
       // print "<br>";
        // fetch the questions 
        foreach ($rows as $row) {
            $qtn = new Question; 
            $qtn->subject_id = Session::get('subject_id');
            $qtn->type = Session::get('question_type');
            $qtn->value = $row[0]; 
            if($qtn->save()){
               # $qtn_id = DB::getPdo()->lastInsertId();
                // look for options
                for($x = 1; $x<=count($row)-1; $x+=2){
                    $opt = new Option; 
                    if($row[$x] !=null){
                        $opt->question_id = $qtn->id; 
                        $opt->value = $row[$x];  
                        $opt->is_correct = $row[$x+1];  
                        $opt->save(); 
                    } ## end if 
                } ## end for loop 
            } ## end qtn saved 
        } ## end foreach 
        ## clear session 
        Session::forget(['subject_id','question_type']);
    }
}
