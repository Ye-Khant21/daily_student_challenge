<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    //
    public function store(Request $request, \App\Models\Challenge $challenge)
    {
        abort_unless(
            $challenge->is_published
                && $challenge->challenge_date === today()->toDateString(),
            403
        );
        $validated = $request->validate([
            'answer' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->submissions()->firstOrCreate([
            'answer' => $validated['answer'],
            'challenge_id' => $challenge->id,
        ]);
        return redirect()->route('home')->with('success', 'Submission created successfully.');
    }
}
