<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run()
    {
        Task::create(['driver_id' => 1, 'status' => 'completed']);
        Task::create(['driver_id' => 2, 'status' => 'waiting']);
    }
}