<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskDestination;

class TaskDestinationSeeder extends Seeder
{
    public function run()
    {
        TaskDestination::insert([
            ['task_id' => 1, 'destination_name' => 'Lokasi A', 'latitude' => -6.2, 'longitude' => 106.8, 'sequence_order' => 1],
            ['task_id' => 1, 'destination_name' => 'Lokasi B', 'latitude' => -6.21, 'longitude' => 106.81, 'sequence_order' => 2],
            ['task_id' => 2, 'destination_name' => 'Lokasi C', 'latitude' => -6.23, 'longitude' => 106.79, 'sequence_order' => 1]
        ]);
    }
}