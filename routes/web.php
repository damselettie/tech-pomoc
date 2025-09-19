<?php

use Illuminate\Support\Facades\Route;


use App\Models\Room;
use App\Models\Issue;
use Illuminate\Http\Request;
use App\Http\Controllers\IssueController;

Route::post('/issue/store', [IssueController::class, 'store'])->name('issue.store');

Route::get('/issue/create', function () {
    return view('issue.create');
});


Route::get('/report', function () {
    return view('report', ['rooms' => Room::all()]);
});

Route::post('/report', function (Request $request) {
    $validated = $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'title' => 'required',
        'description' => 'required',
        'reported_by' => 'required|email',
    ]);

    Issue::create($validated);

    return redirect('/report')->with('success', 'Zgłoszenie zostało wysłane.');



});
