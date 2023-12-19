<?php
// app/Http/Controllers/SupportController.php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::all();

        return view('support.index', compact('tickets'));
    }

    public function create()
    {
        return view('support.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required|string',
        ]);

        SupportTicket::create([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'status' => 0, // 0 for open, 1 for closed
        ]);

        return redirect()->route('support.index')->with('success', 'Support ticket created successfully!');
    }

    public function show(SupportTicket $ticket)
    {
        return view('support.show', compact('ticket'));
    }

    public function closeTicket($ticketId)
{
    // Логика закрытия тикета, например:
    $ticket = SupportTicket::find($ticketId);
    $ticket->status = 0;
    $ticket->save();

    return redirect()->route('support.index')->with('success', 'Ticket has been closed successfully.');
}

}
