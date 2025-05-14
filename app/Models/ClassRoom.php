<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;
    
    public function level(){      
        return $this->belongsTo('App\Models\Level','level_id');
    }
    
    public static function getClassRooms($level_id){
        $rooms = ClassRoom::where('level_id',$level_id)->get();
        return $rooms; 
    }
    
    public static function name($id) {	  
	$classroom = ClassRoom::where('id',$id)->first();        
        return $classroom['name']; 
		 
    }  
    
}
