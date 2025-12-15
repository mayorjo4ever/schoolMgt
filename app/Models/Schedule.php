<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    
    public function users() {
        return $this->hasMany('App\Models\UsersSchedule','schedule_id'); 
    }
    
    public function user() {
        return $this->hasOne('App\Models\UsersSchedule','schedule_id'); 
    }
    
    public function subject(){
       return $this->belongsTo('App\Models\Subject','subject_id'); 
    }
       
    // public function scheduled() {
    //     return $this->hasMany('App\Models\UsersSchedule','schedule_id'); 
    // }

}
