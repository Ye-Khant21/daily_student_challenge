<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

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
    public function index(): View
    {
        $challenges = Challenge::query()
            ->orderByDesc('challenge_date')
            ->paginate(15);

        return view('admin.challenges.index', [
            'challenges' => $challenges,
        ]);
    }

    public function edit(Challenge $challenge): View
    {
        return view('admin.challenges.edit', [
            'challenge' => $challenge,
            'hasSubmissions' => $challenge->submissions()->exists(),
        ]);
    }

    public function update(Request $request, Challenge $challenge): RedirectResponse
    {
        $rules = [
            'is_published' => ['sometimes', 'boolean'],
        ];

        $hasSubmissions = $challenge->submissions()->exists();

        if (! $hasSubmissions) {
            $rules += [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:5000'],
                'challenge_date' => [
                    'required',
                    'date_format:Y-m-d',
                    Rule::unique('challenges', 'challenge_date')->ignore($challenge),
                ],
                'max_points' => ['required', 'integer', 'min:1', 'max:1000'],
            ];
        }

        $validated = $request->validate($rules);

        if (! $hasSubmissions) {
            $challenge->title = $validated['title'];
            $challenge->description = $validated['description'];
            $challenge->challenge_date = $validated['challenge_date'];
            $challenge->max_points = $validated['max_points'];
        }

        $challenge->is_published = $request->boolean('is_published');
        $challenge->save();

        return redirect()
            ->route('admin.challenges.index')
            ->with('success', 'Challenge updated.');
    }
}
