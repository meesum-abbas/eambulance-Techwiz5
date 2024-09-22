<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('UserPannelsss.home');
    }

    public function index()
    {
        $user = Auth::user();
        $userslist = User::where('rolefk', 3)->get();
        return view('AdminPannel.userlist', compact('userslist','user'));
    }
}
