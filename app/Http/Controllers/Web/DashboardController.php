<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    $ongoing = \App\Models\Task::where('status', 'on_delivery')->count();
    $completed = \App\Models\Task::where('status', 'completed')->count();
    $driverCount = \App\Models\User::count();

    return view('admin.dashboard', compact('ongoing', 'completed', 'driverCount'));
}
}