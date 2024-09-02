<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Models\Message;

class WhatsAppController extends Controller
{
    public function showForm()
    {
        $messages = Message::all();
        return view('whatsapp', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $account_sid = env('TWILIO_SID');
        $auth_token = env('TWILIO_AUTH_TOKEN');
        $twilio_phone_number = env('TWILIO_PHONE_NUMBER');
        $receiver_number = 'whatsapp:' . $request->input('receiver_number');
        // dd($receiver_number);
        $client = new Client($account_sid, $auth_token);

        $message = $client->messages->create($receiver_number, [
            'from' => 'whatsapp:' . $twilio_phone_number,
            'body' => $request->input('message'),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Message Sent!');
    }

    public function receiveMessage(Request $request)
    {
        // Parse the incoming message
        $senderNumber = $request->input('From');
        $messageBody = $request->input('Body');

        // Log the message or store it in the database
        \Log::info("Received a message from $senderNumber: $messageBody");

        // Respond to the message (optional)
        // You can send a response back to the user here if needed
        // Or you can store the message in your database for your web application to display
        // Store the message in the database
        $message = new Message();
        $message->sender_number = $senderNumber;
        $message->body = $messageBody;
        $message->save();

        // Return a response to Twilio
        return response()->json(['success' => true]);
    }

    public function showMessages()
    {
        $messages = Message::all();
        return view('messages', compact('messages'));
    }
}
