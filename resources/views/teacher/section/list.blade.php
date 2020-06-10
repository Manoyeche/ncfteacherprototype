@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center">
            <div class="mr-auto h4 mb-0">
                Sections
            </div>
            <div>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addSectionModal" id="addSectionModalBtn">Add Section</button>
            </div>
        </div>

        @if (count($sections) == 0)
            <div class="card-body">
                <p>No record found.</p>
            </div>
        @endif
    </div>

    <br>

    <div class="row">
        @foreach ($sections as $item)
            <div class="col-md-4">
                    <div class="card mb-2">
                        <div class="card-header d-flex flex-wrap align-items-center">
                            <div class="mr-auto h4 mb-0">
                                {{ $item->name }}
                            </div>
                            <div>
                                <button type="button" class="btn btn-dark btn-sm" data-toggle="modal">View</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h4>Students: 0</h4>
                            <h4>Desc: {{ $item->desc }}</h4>
                        </div>
                    </div>
            </div>
        @endforeach
    </div>

</div>

    
<div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-labelledby="addSectionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSectionModalLabel">ADD SECTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher.section.add') }}" method="POST">
                    @csrf       
                    <div class="form-group">
                        <label for="name">Class Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>       
                    <div class="form-group">
                        <label for="year">Year Level:</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ old('year') }}">
                    </div>       
                    <div class="form-group">
                        <label for="formTextarea1">Description</label>
                        <textarea class="form-control" id="formTextarea1" rows="3" name="desc">{{ old('desc') }}</textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success j-form-swal-confirmation" data-confirm-text="Add Section?">Add Section</button>
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
            document.getElementById("addSectionModalBtn").click();
        @endif
        @if (session()->has('errors'))
        
            swal.fire({
                title: 'Error',
                text: "{{ $errors->first() }}",
                icon: 'error'
            });
            document.getElementById("addSectionModalBtn").click();
        @endif
    </script>
@endpush
