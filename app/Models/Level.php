<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    
     public function classroom(){      
        return $this->hasMany('App\Models\ClassRoom');
    }
    
    public static function name($id) {        
        $level = Level::where('id',$id)->first();
        return $level['name'];        
    }  
    
    public function user(){
        return $this->hasMany('App\Models\User','curent_level_id');
    }
}
