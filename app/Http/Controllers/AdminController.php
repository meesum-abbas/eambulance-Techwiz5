<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Feedback;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
class AdminController extends Controller
{
    public function dashboard()
    {

        $userCounts = DB::table('users')
            ->select(DB::raw('DAY(created_at) as day, COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->where('rolefk', 3)
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('count')
            ->toArray();

        $driverCounts = DB::table('users')
            ->select(DB::raw('DAY(created_at) as day, COUNT(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->where('rolefk', 2)
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('count')
            ->toArray();

        return response()->view('AdminPannel.home', [
            'userCounts' => $userCounts,
            'driverCounts' => $driverCounts,
        ])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache');
    }

    public function edit()
    {
        $user = Auth::user();

        return response()
            ->view('AdminPannel.profile', compact('user'))
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
        return redirect('admin/profile/edit')->with('success', 'Profile updated successfully!');
    }

    public function Monitoring(){
        $drivers = User ::where('rolefk', 2)->get();
        return View('AdminPannel.monitoring', compact('drivers'));
    }

    public function showcontact()
{
    $contacts = Contact::all();
    return view('AdminPannel.contactdetails', compact('contacts'));
}

public function showfeedback()
{
    $feedbacks = Feedback::all();
    return view('AdminPannel.feedbackdetails', compact('feedbacks'));
}

}
