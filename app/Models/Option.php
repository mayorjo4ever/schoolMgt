<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    
    public function question() {
         return $this->belongsTo(Question::class);
    }
    
    public function answer() {
       return $this->hasOne(Answer::class);
    }
    
}
