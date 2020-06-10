<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Section;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('authTeacher');
    }

    public function list() {
        $sections = Section::orderBy('created_at', 'desc')->get();

        return view('teacher.section.list')->with([
            'sections' => $sections,
        ]);
    }

    public function addSection(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:sections',
            'year' => 'required',
        ]);

        Section::create([
            'name' => $request->name,
            'year' => $request->year,
            'desc' => $request->desc
        ]);

        return redirect()->back()->with('success', 'Section '.$request->name.' created.');
    }
}
