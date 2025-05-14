<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    public function questions() {
        return $this->hasMany(Question::class);
    }
    
    public static function name($subject_id) {
      $subject = Subject::select('code','title')->where('id',$subject_id)->first()->toArray();
       return $subject['title'];
    }
    public static function subjectName($subject_id) {
      $subject = Subject::select('code','title')->where('id',$subject_id)->first()->toArray();
       return $subject['code']." - ".$subject['title'];
    }
    
     public static function subjectCode($subject_id) {
      $subject = Subject::select('code')->where('id',$subject_id)->first()->toArray();
       return $subject['code'];
    }
    
}
