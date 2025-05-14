<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable2;
use Spatie\Permission\Traits\HasRoles;

class Student extends Authenticable2
{
    use HasFactory; use HasRoles;
    
    protected $guard = 'student'; 
    
    protected $fillable = [
        'surname',
        'name',
        'firstname',
        'othername',
        'email',
        'mobile',
        'password',
        'status'
    ];
    
    public function levels(){
        $relations = "App\Models\UsersClass";
        return $this->hasMany($relations); 
    }
}
