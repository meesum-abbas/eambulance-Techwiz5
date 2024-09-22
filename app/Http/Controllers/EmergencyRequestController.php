<?php

namespace App\Http\Controllers;

use App\Models\emergency_request;
use App\Models\User;
use Illuminate\Http\Request;

class EmergencyRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'hospital_name' => 'required|string',
            'mobile_no' => 'required|regex:/[0-9]{10}/',
            'address' => 'required|string',
            'pickup_address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:emergency,non-emergency',
        ]);

        $emergencyRequest = new emergency_request();
        $emergencyRequest->hospital_name = $request->hospital_name;
        $emergencyRequest->mobile_no = $request->mobile_no;
        $emergencyRequest->address = $request->address;
        $emergencyRequest->pickup_address = $request->pickup_address;
        $emergencyRequest->latitude = $request->latitude;
        $emergencyRequest->longitude = $request->longitude;
        $emergencyRequest->type = $request->type;

        $emergencyRequest->save();

        return redirect()->back()->with('success', 'Request submitted successfully.');
    }

    public function Dispatch()
    { 
        $emergencyRequests = emergency_request::with(['driver' => function ($query) {
                $query->select('id', 'name', 'driver_phone', 'latitude', 'longitude');  
            }])->paginate(10); 
    
        $assignedDriverIds = emergency_request::whereNotNull('driver_id')
                                              ->where('status', '!=', 'completed')
                                              ->pluck('driver_id')
                                              ->toArray(); 
        $drivers = User::where('rolefk', 2)
                       ->whereNotIn('id', $assignedDriverIds)
                       ->get();
        
        return view('AdminPannel.dispatch.Requestdispatch', compact('emergencyRequests', 'drivers'));
    }
    
    
    
    public function assignDriver(Request $request, $id)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);
    
        $emergencyRequest = emergency_request::findOrFail($id);
        $emergencyRequest->driver_id = $request->driver_id;
        $emergencyRequest->status = 'dispatched';
        $emergencyRequest->save(); 
        return redirect()->route('dispatch')->with('success', 'Driver assigned successfully!');
    }
    
    
}
