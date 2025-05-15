<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDestination extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'destination_name', 'latitude', 'longitude', 'sequence_order'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}