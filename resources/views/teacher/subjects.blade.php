@extends('layouts.teacher')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-wrap align-items-center">
            <div class="mr-auto h4 mb-0">
                Subject List
            </div>
            <div>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#addSubjectModal" id="addSubjectModalBtn">Add Subject</button>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Units</th>
                        <th scope="col">Year Level</th>
                        {{-- <th scope="col">---</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $item)
                            <tr>
                                <th scope="row">{{ (($subjects->total() - $subjects->firstItem()) - $loop->index) + 1 }}.</th>
                                <td>
                                    {{ $item->code }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->units }}
                                </td>
                                <td>
                                    {{ $item->year }}
                                </td>
                                {{-- <td>
                                    <a href="{{ route('teacher.student.view', $item->id) }}">
                                        <button type="button" class="btn btn-dark btn-sm">View</button>
                                    </a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $subjects->appends(request()->except('page'))->links() }}
            @if ($subjects->total() == 0)
                <p>No record found.</p>
            @endif
        </div>
    </div>

</div>

    
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectModalLabel">ADD STUDENT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('teacher.subject.add') }}" method="POST">
                    @csrf       
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>        
                    <div class="form-group">
                        <label for="code">Subject Code:</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
                    </div>     
                    <div class="form-group">
                        <label for="units">Units:</label>
                        <input type="number" class="form-control" id="units" name="units" value="{{ old('units') }}">
                    </div>      
                    <div class="form-group">
                        <label for="year">Year Level:</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ old('year') }}">
                    </div>       
                    <br>
                    <button type="submit" class="btn btn-success j-form-swal-confirmation" data-confirm-text="Add Subject?">Add Subject</button>
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
            document.getElementById("addSubjectModalBtn").click();
        @endif
        @if (session()->has('errors'))
        
            swal.fire({
                title: 'Error',
                text: "{{ $errors->first() }}",
                icon: 'error'
            });
            document.getElementById("addSubjectModalBtn").click();
        @endif
    </script>
@endpush
