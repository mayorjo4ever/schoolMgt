<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSubjects extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','subject_ids'];
}
