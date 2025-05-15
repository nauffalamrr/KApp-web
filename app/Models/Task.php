<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'status'];

    public function destinations()
    {
        return $this->hasMany(TaskDestination::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}