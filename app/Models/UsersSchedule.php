<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'schedule_id',
        'paper_status',
        'score',
        'max_score',
        'started_at',
        'ends_at',
        'submitted_at',
        ];
    
    protected $dates = ['started_at', 'ends_at', 'submitted_at'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'users_schedule_id');
    }
    
}
