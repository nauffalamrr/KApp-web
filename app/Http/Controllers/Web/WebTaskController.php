<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class WebTaskController extends Controller
{
    public function index()
    {
        $driversWithTasks = User::leftJoin('tasks', 'users.id', '=', 'tasks.driver_id')
            ->select('users.*', 'tasks.status as task_status')
            ->get();

        return view('admin.tasks', compact('driversWithTasks'));
    }


    public function assignTask(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
            'destinations' => 'required|array|min:1',
            'destinations.*' => 'string|required',
        ]);

        $driver = User::findOrFail($request->driver_id);

        if ($driver->status !== 'free') {
            return redirect()->back()->with('error', 'Driver sedang tidak tersedia');
        }

        $task = Task::create([
            'driver_id' => $driver->id,
            'status' => 'waiting',
        ]);

        foreach ($request->destinations as $index => $destName) {
            $task->destinations()->create([
                'destination_name' => $destName,
                'sequence_order' => $index + 1,
            ]);
        }
        $driver->status = 'waiting';
        $driver->save();

        return redirect()->back()->with('success', 'Task berhasil diberikan ke driver');
    }

    public function history()
    {
        $histories = Task::with(['driver', 'destinations'])
            ->whereIn('status', ['on_delivery', 'completed'])
            ->get();

        return view('admin.history', compact('histories'));
    }
}
