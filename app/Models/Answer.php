<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected  $fillable = ['option_id']; 
    
    public function options() {
       return $this->belongsTo(Option::class);
    }
}
