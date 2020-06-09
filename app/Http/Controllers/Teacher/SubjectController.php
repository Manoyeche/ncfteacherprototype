<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('authTeacher');
    }

    public function list() {
        $subjects = Subject::orderBy('created_at', 'desc')->paginate(10);

        return view('teacher.subjects')->with([
            'subjects' => $subjects
        ]);
    }

    public function addSubject(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'units' => 'required',
            'year' => 'required',
        ]);

        Subject::create([
            'code' => $request->code,
            'name' => $request->name,
            'units' => $request->units,
            'year' => $request->year,
            'desc' => $request->desc,
        ]);

        return redirect()->back()->with('success', 'Subject '.$request->name.' created.');
    }
}
