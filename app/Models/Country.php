<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;   protected $table = "countries";
    
    public function state() {
        return $this->hasMany('App\Models\State');
    }
    
    public function city() {
        return $this->hasMany('App\Models\City');
    }
    
    public static function countries(){
        return $countries = Country::select('id','name','numeric_code','phonecode','capital','currency')->get();
    }
    
    public static function getStates($country_id){
        return $states = State::select('id','name','iso2')->where('country_id',$country_id)->orderBy('name')->get();
    } #
    public static function name($id) {
        $result = Country::where('id',$id)->first();
        return $result['name']; 
    }  
  }
