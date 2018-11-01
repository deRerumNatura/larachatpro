<?php

namespace App\Http\Controllers;

use App\Events\ReceivedMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Message::with('user')->get();
        }
        return view('messages.index')->with('messages', Message::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Message $message)
    {
        $request->validate([
            'message' => 'max:200',
        ]);

        $message->message = $request->message;
        $message->user()->associate($request->user());

        $message->save();

        event(new ReceivedMessage($message, auth()->user()));

        return response()->json(['success' => 'success'], 200);
    }
}