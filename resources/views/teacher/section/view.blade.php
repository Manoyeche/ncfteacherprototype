@extends('layouts.teacher')

@section('content')
<div class="container" id="teacherSection" v-cloak>
    <div class="card mb-3">
        <div class="card-header d-flex flex-wrap align-items-center">
            <div class="mr-auto h4 mb-0">
                Section {{ $section->name }}
            </div>
        </div>
        <div class="card-body">
            <div class="card-body">
                <h4>Students: {{ $section->students()->count() }}</h4>
                <h4>Desc: {{ $section->desc }}</h4>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header d-flex flex-wrap align-items-center">
            <div class="mr-auto mb-0">
                Students
            </div>
            <div>
                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#addStudentModal" id="addStudentModalBtn">Add Student</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-sm">
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
                                    {{ $item->user->studentProfile->student_no }}
                                </td>
                                <td>
                                    {{ $item->user->profile->fullname }}
                                </td>
                                <td>
                                    {{ $item->user->studentProfile->course }}
                                </td>
                                <td>
                                    {{ $item->user->studentProfile->year }}
                                </td>
                                <td>
                                    <a href="{{ route('teacher.student.view', $item->user->id) }}">
                                        <button type="button" class="btn btn-dark btn-sm">View</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- {{ $students->appends(request()->except('page'))->links() }} --}}
            @if (count($students) == 0)
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
