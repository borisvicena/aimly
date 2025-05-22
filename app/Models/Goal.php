<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'goals';

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'status',
        'created_at',
        'updated_at'
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class, 'goal_id', 'id');
    }
}
