<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminClassGroups extends Model
{
    use HasFactory;
    protected $fillable = ['admin_id','classroom_ids'];
}
