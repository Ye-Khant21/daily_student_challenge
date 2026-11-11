<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;

class ChallengeController extends Controller
{
    //
    public function index(Request $request)
    {
        $challenges = Challenge::where('is_published', true)
            ->where('challenge_date', today()->toDateString())
            ->first();

        $submission = null;
        if ($challenges && $request->user()) {
            $submission = $request->user()->submissions()->where('challenge_id', $challenges->id)->first();
        }
        return view(
            'challenges.home',
            ['challenge' => $challenges, 'submission' => $submission]
        );
    }
    public function history()
    {
        $challenges = Challenge::where('is_published', true)
            ->where('challenge_date', '<', today())
            ->orderBy('challenge_date', 'desc')
            ->get();
        return view(
            'challenges.history',
            ['challenges' => $challenges]
        );
    }
}
