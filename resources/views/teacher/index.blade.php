@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Teacher Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            You are logged in! {{ auth()->user()->profile->fullname }}
            <br><br>
            
            <a href="{{ route('teacher.student.list') }}" class="btn btn-dark">Student List</a>
            <button class="btn btn-dark">Grades</button>
            <button class="btn btn-dark">Attendance</button>
        </div>
    </div>

</div>
@endsection
