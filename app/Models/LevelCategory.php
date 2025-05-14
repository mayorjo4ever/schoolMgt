<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelCategory extends Model
{
    use HasFactory; protected $table = 'level_categories';
    
    public static function name($id){
        $name = LevelCategory::where('id',$id)->get()->first()->toArray();
        return $name['name'];
    }
}
