<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalDelivery' => Task::count(),
            'ongoing' => Task::where('status', 'on_delivery')->count(),
            'totalDriver' => User::count(),
        ]);
    }
}