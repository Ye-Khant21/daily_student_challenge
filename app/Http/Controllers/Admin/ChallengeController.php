<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChallengeController extends Controller
{
    public function create(): View
    {
        return view('admin.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'challenge_date' => ['required', 'date_format:Y-m-d', 'unique:challenges,challenge_date'],
            'max_points' => ['required', 'integer', 'min:1', 'max:1000'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
        $challenge = new Challenge;
        $challenge->title = $validated['title'];
        $challenge->description = $validated['description'];
        $challenge->challenge_date = $validated['challenge_date'];
        $challenge->max_points = $validated['max_points'];
        $challenge->is_published = $request->boolean('is_published');
        $challenge->creator()->associate($request->user());
        $challenge->save();

        return redirect()->route('admin.submissions.index')->with('success', 'Challenge created successfully.');
    }
}
