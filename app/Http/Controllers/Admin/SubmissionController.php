<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {

        $submissions = Submission::with('challenge', 'user')->latest()->paginate(10);

        return view('admin.dashboard', [
            'submissions' => $submissions,
        ]);
    }

    public function approve(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'points_awarded' => ['required', 'integer', 'min:0', 'max:'.$submission->challenge->max_points],
            'feedback' => ['nullable', 'string', 'max:2000'],

        ]);
        $updated = Submission::query()
            ->where('id', $submission->getKey())
            ->WhereNull('reviewed_at')
            ->update([
                'points_awarded' => $validated['points_awarded'],
                'feedback' => $validated['feedback'],
                'reviewed_at' => now(),
            ]);

        return redirect()->route('admin.submissions.index')->with('success', 'Submission approved successfully.');
    }
}
