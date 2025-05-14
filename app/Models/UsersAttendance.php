<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAttendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id']; 
    
    public static function CountDaysPresent($user_id,$session,$term,$class_room_id){
        return self::where(['user_id'=>$user_id,'session'=>$session,'term'=>$term,
            'class_room_id'=>$class_room_id])->count();
    }
}
