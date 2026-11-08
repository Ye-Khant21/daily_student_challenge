<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;

class ChallengeController extends Controller
{
    //
    public function index()
    {
        $challenges = Challenge::where('is_published', true)
            ->where('challenge_date', today())
            ->first();
        return view(
            'challenges.home',
            ['challenge' => $challenges]
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
