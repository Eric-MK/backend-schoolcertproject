<?php

namespace App\Http\Controllers;

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

        $user = Auth::user();

        $ticket = Ticket::where('user_id', $user->id)->first();

        if ($ticket) {
            return response()->json(['message' => 'Ticket already purchased'], 400);
        }

        $quantity = $request->input('quantity');
        $totalPrice = $quantity * 10; // Assuming ticket price is $10

        $ticket = new Ticket();
        $ticket->user_id = $user->id;
        $ticket->quantity = $quantity;
        $ticket->total_price = $totalPrice;
        $ticket->save();

        return response()->json([
            'message' => 'Ticket purchased successfully',
            'ticket' => $ticket,
        ], 201);
    }

    public function userTickets()
    {
        $user = Auth::user();
        $ticket = Ticket::where('user_id', $user->id)->first();

        if (!$ticket) {
            return response()->json(['message' => 'No ticket purchased'], 404);
        }

        return response()->json([
            'ticket' => $ticket,
        ], 200);
    }

    public function delete()
    {
        $user = Auth::user();
        $ticket = Ticket::where('user_id', $user->id)->first();

        if (!$ticket) {
            return response()->json(['message' => 'No ticket purchased'], 404);
        }

        $ticket->delete();

        return response()->json(['message' => 'Ticket deleted successfully']);
    }
}
