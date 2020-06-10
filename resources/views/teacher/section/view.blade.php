@extends('layouts.teacher')

@section('content')
<div class="container" id="teacherSection" v-cloak>
    <input type="hidden" value="{{ $section->id }}" ref="section_id">
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
                        <tr v-for="(item, index) in student.datas">
                            <th scope="row">@{{ index + 1 }}.</th>
                            <td>
                                @{{ item.user.student_profile.student_no }}
                            </td>
                            <td>
                                @{{ item.user.profile.fullname }}
                            </td>
                            <td>
                                @{{ item.user.student_profile.course }}
                            </td>
                            <td>
                                @{{ item.user.student_profile.year }}
                            </td>
                            <td>
                                <a href="#">
                                    <button type="button" class="btn btn-dark btn-sm">View</button>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <p v-if="student.datas.length == 0">No record found.</p>
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
