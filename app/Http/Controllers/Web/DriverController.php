<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::all();
        return view('admin.drivers', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'status' => 'free',
            'vehicle_type' => 'car',
        ]);

        return redirect()->back()->with('success', 'Driver added successfully');
    }

    public function update(Request $request, $id)
    {
        $driver = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => "required|string|max:255|unique:users,username,$id",
            'password' => 'nullable|string'
        ]);

        $driver->name = $request->name;
        $driver->username = $request->username;

        if ($request->password) {
            $driver->password = Hash::make($request->password);
        }

        $driver->save();

        return redirect()->back()->with('success', 'Driver updated successfully');
    }

    public function destroy($id)
    {
        $driver = User::findOrFail($id);
        $driver->delete();

        return redirect()->back()->with('success', 'Driver deleted successfully');
    }
}