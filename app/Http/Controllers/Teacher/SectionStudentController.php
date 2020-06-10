<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\SectionStudent;

class SectionStudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('authTeacher');
    }

    public function getStudents(Request $request) {
        if (!validateValue($request->section_id, 'exists:sections,id')) {
            return [
                'status' => 0,
                'datas' => [],
                'errors' => [
                    'section' => 'Invalid Section ID.'
                ]
            ];
        }

        $datas = SectionStudent::with('user.studentProfile', 'user.profile')->where('section_id', $request->section_id)->get();

        return [
            'status' => 1,
            'datas' => $datas
        ];
    }
}
