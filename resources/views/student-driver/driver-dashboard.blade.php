@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>My Students</h2>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Assigned Students Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h4>Assigned Students</h4>
            @if ($myStudents->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myStudents as $assignment)
                                <tr>
                                    <td>{{ $assignment->student->name }}</td>
                                    <td>{{ $assignment->student->email }}</td>
                                    <td>{{ $assignment->student->parent_contact ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ ucfirst($assignment->status) }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('student-driver.driver-remove', $assignment->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Remove this student?')">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No students assigned yet. Select one below.</p>
            @endif
        </div>
    </div>

    <!-- Available Students Section -->
    <div class="row">
        <div class="col-md-12">
            <h4>Available Students</h4>
            @if ($availableStudents->count())
                <div class="row">
                    @foreach ($availableStudents as $student)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $student->name }}</h5>
                                    <p class="card-text text-muted">{{ $student->email }}</p>
                                    @if ($student->present_address)
                                        <p class="card-text"><small>{{ $student->present_address }}</small></p>
                                    @endif
                                    @if ($student->parent_contact)
                                        <p class="card-text"><small>Contact: {{ $student->parent_contact }}</small></p>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-top">
                                    <form action="{{ route('student-driver.driver-select') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                                        <button class="btn btn-success btn-sm w-100" type="submit">Select Student</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No available students. All students are already assigned.</p>
            @endif
        </div>
    </div>
</div>
@endsection
