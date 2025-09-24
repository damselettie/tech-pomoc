<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\User;

class IssueController extends Controller
{
   public function store(Request $request)
{
    // Walidacja danych wejściowych
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'reporter_name' => 'required|string|max:255',
        'role' => 'required|in:informatyk,sprzatacz,dyrektor',
    ]);

    // Tworzenie nowego zgłoszenia
    $issue = Issue::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'reporter_name' => $validated['reporter_name'],
    ]);

    // Pobieranie użytkowników z wybraną rolą
    $users = User::where('role', $validated['role'])->get();

    // Przypisanie użytkowników do zgłoszenia
    foreach ($users as $user) {
        $issue->recipients()->attach($user->id);
    }

    // Przekierowanie z komunikatem sukcesu
    return redirect()->back()->with('success', 'Zgłoszenie zostało dodane i przypisane do odpowiednich użytkowników.');
}
    
}
