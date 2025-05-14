<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;    protected $table = "cities";
    
     public function country() {
        return $this->belongsTo('App\Models\Country','country_id');
    }
    
     public function state() {
        return $this->belongsTo('App\Models\State','state_id');
    }
    
    public static function name($id) {
        $result = City::where('id',$id)->first();
        return $result['name']; 
    }  
    
}
