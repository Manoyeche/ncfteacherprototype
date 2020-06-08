@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center">
            <div class="mr-auto">
                Student List
            </div>
            <div>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addStudentModal" id="addStudentModalBtn">Add Student</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student #</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Year Level</th>
                        <th scope="col">---</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $item)
                            <tr>
                                <th scope="row">{{ (($students->total() - $students->firstItem()) - $loop->index) + 1 }}.</th>
                                <td>
                                    {{ $item->studentProfile->student_no }}
                                </td>
                                <td>
                                    {{ $item->profile->fullname }}
                                </td>
                                <td>
                                    {{ $item->studentProfile->course }}
                                </td>
                                <td>
                                    {{ $item->studentProfile->year }}
                                </td>
                                <td>
                                    <a href="{{ route('teacher.student.view', $item->id) }}">
                                        <button type="button" class="btn btn-dark btn-sm">View</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $students->appends(request()->except('page'))->links() }}
            @if ($students->total() == 0)
                <p>No record found.</p>
            @endif
        </div>
    </div>

</div>

    
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">ADD STUDENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher.student.add') }}" method="POST">
                    @csrf       
                    <div class="form-group">
                        <label for="student_no">Student Number:</label>
                        <input type="text" class="form-control" id="student_no" name="student_no" value="{{ old('student_no') }}">
                    </div>        
                    <div class="form-group">
                        <label for="first_name">First name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
                    </div>     
                    <div class="form-group">
                        <label for="middle_name">Middle name:</label>
                        <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                    </div>      
                    <div class="form-group">
                        <label for="last_name">Last name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}">
                    </div>    
                    <div class="form-group">
                        <label for="suffix">Suffix:</label>
                        <input type="text" class="form-control" id="suffix" name="suffix" value="{{ old('suffix') }}">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="course">Course:</label>
                        <input type="text" class="form-control" id="course" name="course" value="{{ old('course') }}">
                    </div>    
                    <div class="form-group">
                        <label for="year">Year Level:</label>
                        <input type="text" class="form-control" id="year" name="year" value="{{ old('year') }}">
                    </div>       
                    <br>
                    <button type="submit" class="btn btn-success j-form-swal-confirmation" data-confirm-text="Add Student?">Add Student</button>
                </form>
            </div>
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
