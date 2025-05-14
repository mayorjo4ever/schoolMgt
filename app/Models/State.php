<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    
    public function country() {
        return $this->belongsTo('App\Models\Country','country_id');
    }
    
    public function city() {
        return $this->hasMany('App\Models\City');
    }
    
    public static function getCities($state_id){
        return $cities = City::select('id','name')->where('state_id',$state_id)->orderBy('name')->get();
    } 
    
    public static function name($id) {
        $result = State::where('id',$id)->first();
        return $result['name']; 
    }  
}
