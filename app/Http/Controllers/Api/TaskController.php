<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskDestination;
use App\Models\User;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $tasks = Task::with('destinations')
        ->where('driver_id', $user->id)
        ->get();

    return response()->json($tasks);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        $task = Task::with('destinations')->where('id', $id)->where('driver_id', $user->id)->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    public function accept(Request $request, $id)
    {
        $user = $request->user();

        $task = Task::where('id', $id)
        ->where('driver_id', $user->id)
        ->where('status', 'waiting')
        ->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or cannot be accepted'], 404);
        }

        $task->status = 'delivery';
        $task->save();

        $user->status = 'delivery';
        $user->save();

        return response()->json(['message' => 'Task accepted', 'task' => $task]);
    }

    public function complete(Request $request, $id)
    {
        $user = $request->user();

        $task = Task::where('id', $id)
        ->where('driver_id', $user->id)
        ->where('status', 'delivery')
        ->first();

        if (!$task) {
            return response()->json(['message' => 'Task not found or cannot be completed'], 404);
        }

        $task->status = 'completed';
        $task->save();

        $user->status = 'free';
        $user->save();

        return response()->json(['message' => 'Task completed', 'task' => $task]);
    }

    public function history(Request $request)
    {
        $user = $request->user();

        $histories = Task::with('destinations')
        ->where('driver_id', $user->id)
        ->whereIn('status', ['delivery', 'completed'])
        ->get();

        return response()->json($histories);
    }

    public function detail(Request $request, $id)
    {
        $user = $request->user();

        $task = Task::with('destinations')
            ->where('id', $id)
            ->where('driver_id', $user->id)
            ->whereIn('status', ['delivery', 'completed'])
            ->first();

        if (!$task) {
            return response()->json(['message' => 'History not found'], 404);
        }

        return response()->json($task);
    }

    public function updateDestination(Request $request, $task_id)
    {
        $request->validate([
            'destinations' => 'required|array|min:1',
            'destinations.*.destination_name' => 'required|string',
            'destinations.*.latitude' => 'required|numeric',
            'destinations.*.longitude' => 'required|numeric',
        ]);

        $task = Task::findOrFail($task_id);
        
        if ($task->driver_id !== $request->user()->id || $task->status !== 'delivery') {
            return response()->json(['message' => 'Unauthorized or Task is not in progress'], 403);
        }

        foreach ($request->destinations as $index => $destination) {
            $task->destinations()->where('id', $destination['id'])->update([
                'latitude' => $destination['latitude'],
                'longitude' => $destination['longitude'],
            ]);
        }

        return response()->json(['message' => 'Destinations updated successfully']);
    }

}