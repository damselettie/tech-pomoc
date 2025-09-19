<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'room_number' => 'required|string|max:50',
            'computer_number' => 'required|string|max:50',
            'reporter_name' => 'required|string|max:255',
            'recipients' => 'required|array',
            'recipients.*' => 'exists:users,id',
        ]);

        // Tworzymy zgłoszenie bez pola recipients bo to relacja many-to-many
        $issue = Issue::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'room_number' => $validated['room_number'],
            'computer_number' => $validated['computer_number'],
            'reporter_name' => $validated['reporter_name'],
        ]);

        // Sync odbiorców (userów)
        $issue->recipients()->sync($validated['recipients']);

        // Przekierowanie z komunikatem sukcesu
        return redirect()->back()->with('success', 'Zgłoszenie zostało dodane i przypisane do odbiorców!');
    }
}
