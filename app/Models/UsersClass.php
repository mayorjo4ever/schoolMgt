<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersClass extends Model
{
    use HasFactory;
    protected $fillable = ['user_id']; 
    
   public function users()
    {
        return $this->hasMany(User::class);
    } 
    
    public static function total_in_class($id, $session) {
        return $total = UsersClass::where(['class_room_id'=>$id,'session'=>$session])->count();
    }
}
