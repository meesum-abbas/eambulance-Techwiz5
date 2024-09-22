<?php
namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    // public function fetchMessages($receiverId)
    // {
    //     $messages = Message::where(function($query) use ($receiverId) {
    //         $query->where('sender_id', Auth::id())
    //               ->where('receiver_id', $receiverId);
    //     })->orWhere(function($query) use ($receiverId) {
    //         $query->where('sender_id', $receiverId)
    //               ->where('receiver_id', Auth::id())
    //               ->orderBy('created_at', 'asc');

    //     })->get();

    //     return response()->json($messages);
    // }
    public function fetchMessages($receiverId)
{
    $messages = Message::where(function($query) use ($receiverId) {
        $query->where('sender_id', Auth::id())
              ->where('receiver_id', $receiverId);
    })->orWhere(function($query) use ($receiverId) {
        $query->where('sender_id', $receiverId)
              ->where('receiver_id', Auth::id());
    })->orderBy('created_at', 'asc')->get();

    return response()->json($messages);
}

}