<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Send a message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $message = Message::create([
            'name' => $request->name,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }

    /**
     * Get list of all messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMessages()
    {
        $messages = Message::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Messages retrieved successfully',
            'data' => $messages,
            'total' => $messages->count()
        ], 200);
    }
}
