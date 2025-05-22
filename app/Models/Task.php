<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $connection = 'mysql';
    protected $table = 'tasks';

    protected $fillable = [
        'goal_id',
        'title',
        'due_date',
        'status',
        'created_at',
        'updated_at'
    ];


    public function goal()
    {
        return $this->belongsTo(Goal::class, 'goal_id', 'id');
    }
}
