<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\User;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        $drivers = User::where('rolefk', 2)->get(); 
        $ambulancelist = Ambulance::distinct()->get();
        return View('UserPannel.home', compact('ambulancelist','drivers'));
    }

}
