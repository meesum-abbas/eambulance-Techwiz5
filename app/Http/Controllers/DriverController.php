<?php

namespace App\Http\Controllers;

use App\Models\emergency_request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function dashboard()
    {
        return view('DriverPannel.home');
    }

    public function edit()
    { 
        $user = Auth::user();

        return response()
            ->view('DriverPannel.profile', compact('user'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|confirmed|min:8',
            'bio' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'about_me' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->phone = $request->phone;
        $user->date_of_birth = $request->date_of_birth;
        $user->about_me = $request->about_me;

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image'), $imageName);
            $user->image = 'image/' . $imageName;
        }

        $user->save();
        return redirect('driver/profile/edit')->with('success', 'Profile updated successfully!');
    }

    public function showbookings()
    {
        $driverId = Auth::user()->id;
        $emergencyRequests = emergency_request::where('driver_id', $driverId)
            ->with('driver') 
            ->get();
    
        $driver = Auth::user(); 
        return view('DriverPannel.bookings', compact('emergencyRequests', 'driver'));
    }
    public function completeRide($id)
    {
        $emergencyRequest = emergency_request::find($id);
        
        if ($emergencyRequest) {
            $emergencyRequest->status = 'completed'; 
            $emergencyRequest->driver_id = null; // Update status
            $emergencyRequest->save();
            
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }
     

}
