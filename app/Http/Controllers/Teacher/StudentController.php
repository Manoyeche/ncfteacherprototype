<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\User;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('authTeacher');
    }

    public function list() {
        $students = User::where('user_type', 2);

        return view('teacher.student.list')->with([
            'students' => $students->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function viewStudent($id) {
        $user = User::where('user_type', 2)->findOrFail($id);

        return $user;
    }

    public function addStudent(Request $request) {
        $validatedData = $request->validate([
            'student_no' => 'required|unique:student_profiles',
            'first_name' => 'required',
            'last_name' => 'required',
            'year' => 'required',
        ]);

        $temp_password = Str::random(6);

        $user = new User;
        $user->name = $request->student_no;
        $user->password = bcrypt($temp_password);
        $user->temp_password = $temp_password;
        $user->save();

        $user->profile()->create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'suffix' => $request->suffix,
        ]);

        $user->studentProfile()->create([
            'student_no' => $request->student_no,
            'course' => $request->course,
            'year' => $request->year,
        ]);

        return redirect()->route('teacher.student.view', $user->id);
    }
}
