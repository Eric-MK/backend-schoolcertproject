<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function purchase(Request $request)
{
    $validator = Validator::make($request->all(), [
        'quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $userId = $request->input('user_id'); // Assuming the user ID is passed in the request
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $ticket = Ticket::where('user_id', $userId)->first();

    if ($ticket) {
        return response()->json(['message' => 'Ticket already purchased'], 400);
    }

    $quantity = $request->input('quantity');
    $totalPrice = $quantity * 10; // Assuming ticket price is $10

    $ticket = new Ticket();
    $ticket->user_id = $userId;
    $ticket->quantity = $quantity;
    $ticket->total_price = $totalPrice;
    $ticket->save();

    return response()->json([
        'message' => 'Ticket purchased successfully',
        'ticket' => $ticket,
    ], 201);
}
public function userTickets($userId)
{
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $ticket = Ticket::where('user_id', $userId)->first();

    if (!$ticket) {
        return response()->json(['message' => 'No ticket purchased'], 404);
    }

    return response()->json([
        'ticket' => $ticket,
    ], 200);
}

public function delete($userId)
{
    $user = User::find($userId);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $ticket = Ticket::where('user_id', $userId)->first();

    if (!$ticket) {
        return response()->json(['message' => 'No ticket purchased'], 404);
    }

    $ticket->delete();

    return response()->json(['message' => 'Ticket deleted successfully']);
}


}
