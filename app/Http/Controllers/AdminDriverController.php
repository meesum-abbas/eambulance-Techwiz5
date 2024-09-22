<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AdminDriverController extends Controller
{
    public function index()
    {
        $drivers = User::where('rolefk', 2)->get();
        return view('AdminPannel.drivers.index', compact('drivers'));
    }

    public function create()
    {
        $ambulances = Ambulance::whereDoesntHave('users', function ($query) {
            $query->whereNotNull('ambulance_id');
        })->get();
    
        return view('AdminPannel.drivers.create', compact('ambulances'));
    }
    

    public function store(Request $request)
    {

        $request->validate([
            'driver_name' => 'required|string|max:255',
            'driver_license_no' => 'required|string|max:255|unique:users',
            'driver_address' => 'required|string',
            'driver_phone' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'driver_image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'ambulance_id' => 'required|exists:ambulances,id',
        ]);



        $imagePath = null;
        if ($request->hasFile('driver_image')) {
            $imageName = time() . '.' . $request->driver_image->extension();
            $imagePath = 'drivers/' . $imageName;
            $request->driver_image->move(public_path('drivers'), $imageName);
        }


        User::create([
            'name' => $request->driver_name,
            'username' => $request->username,
            'driver_license_no' => $request->driver_license_no,
            'driver_address' => $request->driver_address,
            'driver_phone' => $request->driver_phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $imagePath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'rolefk' => 2,
            'ambulance_id' => $request->ambulance_id,
        ]);

        return redirect()->route('showdrivers')->with('success', 'Driver created successfully.');
    }

    public function edit(User $driver)
    {
        $ambulances = Ambulance::Where('id', $driver->ambulance_id)->get();
        return view('AdminPannel.drivers.edit', compact('driver','ambulances'));
    }

    public function update(Request $request, User $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'driver_license_no' => 'required|string|max:255|unique:users,driver_license_no,' . $driver->id,
            'driver_address' => 'required|string',
            'driver_phone' => 'required|string|max:15',
            'username' => 'required|string|max:255|unique:users,username,' . $driver->id,
            'email' => 'required|email|max:255|unique:users,email,' . $driver->id,
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($request->filled('password')) {
            $driver->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = 'drivers/' . $imageName;
            $request->image->move(public_path('drivers'), $imageName);
            $driver->image = $imagePath;
        }

        $driver->update($request->except('image', 'password'));

        return redirect()->route('showdrivers')->with('success', 'Driver updated successfully.');
    }

    public function destroy(User $driver)
    {
        $driver->delete();
        return redirect()->route('showdrivers')->with('success', 'Driver deleted successfully.');
    }
}
