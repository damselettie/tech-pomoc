<?php

use Illuminate\Support\Facades\Route;


use App\Models\Room;
use App\Models\Issue;
use Illuminate\Http\Request;
use App\Http\Controllers\IssueController;

Route::post('/', [IssueController::class, 'store'])->name('issue.store');

Route::get('/', function () {
    return view('issue.create');
});


Route::get('/set-locale/{locale}', function ($locale) {
    $availableLocales = ['pl', 'en', 'de'];

    if (in_array($locale, $availableLocales)) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('setLocale');

Route::get('/language/switch/{locale}', function ($locale) {
    // Save selected locale in session
    session(['locale' => $locale]);

    // Redirect back to previous page
    return redirect()->back();
})->name('language.switch');


// Route::get('/report', function () {
//     return view('report', ['rooms' => Room::all()]);
// });

// Route::post('/report', function (Request $request) {
//     $validated = $request->validate([
//         'room_id' => 'required|exists:rooms,id',
//         'title' => 'required',
//         'description' => 'required',
//         'reported_by' => 'required|email',
//     ]);

//     Issue::create($validated);

//     return redirect('/report')->with('success', 'Zgłoszenie zostało wysłane.');



// });
