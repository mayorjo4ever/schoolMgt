<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAttendanceLog extends Model
{
    use HasFactory;
    protected $fillable = ['session'];
    
    public static function CountDaysOpened($session,$term,$class_room_id){
        return self::where(['session'=>$session,'term'=>$term,
            'class_room_id'=>$class_room_id])->count();
    }
    
    public static function DaysOpened($session,$term,$class_room_id){
        return self::select('date')->where(['session'=>$session,'term'=>$term,
            'class_room_id'=>$class_room_id])->get()->pluck('date')->toArray();
    }
       
}
