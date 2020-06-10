@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center">
            <div class="mr-auto h4 mb-0">
                Classes
            </div>
            <div>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addClassModal" id="addClassModalBtn">Add Class</button>
            </div>
        </div>

        <div class="card-body">
            @if (count($classes) == 0)
                <p>No record found.</p>
            @endif
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-4">
            @foreach ($classes as $item)
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div class="mr-auto h4 mb-0">
                            {{ $item->name }}
                        </div>
                        <div>
                            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal">View</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Subject: {{ $item->subject->name }}</h4>
                        <h4>Section: {{ $item->section->name }}</h4>
                        <h4>Desc: {{ $item->desc }}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

    
<div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">ADD CLASS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher.class.add') }}" method="POST">
                    @csrf       
                    <div class="form-group">
                        <label for="name">Class Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>     
                    <div class="form-group">
                        <label for="formselect2">Subject</label>
                        <select class="form-control" id="formselect2" name="subject_id">
                            <option></option>
                            @foreach ($subjects as $item)
                                <option value="{{ $item->id }}" {{ old('subject_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div> 
                    <div class="form-group">
                        <label for="formselect1">Section</label>
                        <select class="form-control" id="formselect1" name="section_id">
                            <option></option>
                            @foreach ($sections as $item)
                                <option value="{{ $item->id }}" {{ old('section_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>       
                    <div class="form-group">
                        <label for="formTextarea1">Description</label>
                        <textarea class="form-control" id="formTextarea1" rows="3" name="desc">{{ old('desc') }}</textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success j-form-swal-confirmation" data-confirm-text="Add Class?">Add Class</button>
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
            document.getElementById("addClassModalBtn").click();
        @endif
        @if (session()->has('errors'))
        
            swal.fire({
                title: 'Error',
                text: "{{ $errors->first() }}",
                icon: 'error'
            });
            document.getElementById("addClassModalBtn").click();
        @endif
    </script>
@endpush
