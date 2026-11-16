<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index(Request $request)
    {
        $student = $request->user();
        return view('student.dashboard', [
            'submissions' => $student->submissions()->with('challenge')->latest()->paginate(10),
            'totalPoints' => $student->submissions()->whereNotNull('reviewed_at')->sum('points_awarded'),
        ]);
    }
}
