<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Create a new feedback entry in the database
        Feedback::create($request->all());

        // Redirect with a success message
        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }
}