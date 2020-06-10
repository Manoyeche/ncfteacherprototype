<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\TeacherClass;
use App\Subject;
use App\Section;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('authTeacher');
    }

    public function list() {
        $classes = TeacherClass::orderBy('created_at', 'desc')->get();
        $subjects = Subject::get();
        $sections = Section::get();

        return view('teacher.class.list')->with([
            'classes' => $classes,
            'subjects' => $subjects,
            'sections' => $sections
        ]);
    }

    public function addClass(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'subject_id' => 'required|exists:subjects,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        TeacherClass::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'desc' => $request->desc
        ]);
        
        return redirect()->back()->with('success', 'Class '.$request->name.' created.');
    }
}
