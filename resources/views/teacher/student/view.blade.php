@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center">
            <div class="mr-auto">
                Student #{{ $data->studentProfile->student_no }}
            </div>
            {{-- <div>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addStudentModal" id="addStudentModalBtn">Add Student</button>
            </div> --}}
        </div>

        <div class="card-body">
            <h3>Name: {{ $data->profile->fullname }}</h3>
            <h3>Course: {{ $data->studentProfile->course }}</h3>
            <h3>Year: {{ $data->studentProfile->year }}</h3>
        </div>
    </div>

</div>

@endsection


@push('scripts')
    <script>
        @if (session()->has('success'))
        
            swal.fire({
                title: 'Success',
                text: "{{ session('success') }}",
                icon: 'success'
            });
    
        @endif
        @if (session()->has('error'))
        
            swal.fire({
                title: 'error',
                text: "{{ session('error') }}",
                icon: 'error'
            });
            document.getElementById("addStudentModalBtn").click();
        @endif
        @if (session()->has('errors'))
        
            swal.fire({
                title: 'Error',
                text: "{{ $errors->first() }}",
                icon: 'error'
            });
            document.getElementById("addStudentModalBtn").click();
        @endif
    </script>
@endpush
