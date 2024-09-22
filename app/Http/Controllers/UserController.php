<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\MedicalCard;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $drivers = User ::where('rolefk', 2)->get(); 
        return view('UserPannelsss.home',compact('drivers'));
    }

    public function index()
    {
        $drivers = User ::where('rolefk', 2)->get(); 
        $user = Auth::user();
        $userslist = User::where('rolefk', 3)->get();
        $ambulancelist = Ambulance::distinct()->get(); 
        return view('AdminPannel.userlist', compact('userslist','user','ambulancelist','drivers'));
    }


    public function profile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $medicalCard = MedicalCard::where('user_id', $user->id)->first();
    
            return view('UserPannel.profile', compact('user', 'medicalCard'));
        } else {
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'driver_address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6|confirmed', // Add password validation if needed
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Update user details
        $user->name = $validatedData['name'];
        $user->phone = $validatedData['phone'];
        $user->date_of_birth = $validatedData['date_of_birth'];
        $user->driver_address = $validatedData['driver_address']; 

        // Update password if provided
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Save the user
        $user->save();

        // Return a success response
        return response()->json(['success' => 'Profile updated successfully']);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'medical_histroy' => 'nullable|string',
            'allergies' => 'nullable|string',
            'contact_name' => 'required|string|max:255',
            'relation' => 'required|string|max:255',
            'contact_number' => 'required|string|max:11|min:10', // For a valid phone number
        ]);

        // Return validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        // Store the data in the medical_cards table
        $medicalCard = new MedicalCard();
        $medicalCard->user_id = auth()->id(); // Assuming the user is logged in
        $medicalCard->medical_history = $request->input('medical_histroy');
        $medicalCard->allergies = $request->input('allergies');
        $medicalCard->name = $request->input('contact_name');
        $medicalCard->relation = $request->input('relation');
        $medicalCard->contact_no = $request->input('contact_number');
        $medicalCard->save();

        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Medical card saved successfully!'
        ]);
    }
}
