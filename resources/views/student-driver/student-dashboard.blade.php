@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>My Driver Requests</h2>
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

    <!-- Current Requests Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h4>Your Requests</h4>
            @if ($myRequests->count())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Driver Name</th>
                                <th>Driver Email</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myRequests as $request)
                                <tr>
                                    <td>{{ $request->driver->name }}</td>
                                    <td>{{ $request->driver->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $request->status === 'accepted' ? 'success' : 'warning' }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($request->status === 'pending')
                                            <form action="{{ route('student-driver.student-reject', $request->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">Cancel</button>
                                            </form>
                                        @else
                                            <form action="{{ route('student-driver.student-reject', $request->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">Remove</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No requests yet. Find a driver below.</p>
            @endif
        </div>
    </div>

    <!-- Available Drivers Section -->
    <div class="row">
        <div class="col-md-12">
            <h4>Available Drivers</h4>
            @if ($availableDrivers->count())
                <div class="row">
                    @foreach ($availableDrivers as $driver)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $driver->name }}</h5>
                                    <p class="card-text text-muted">{{ $driver->email }}</p>
                                    @if ($driver->present_address)
                                        <p class="card-text"><small>{{ $driver->present_address }}</small></p>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-top">
                                    <form action="{{ route('student-driver.student-request') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                                        <button class="btn btn-primary btn-sm w-100" type="submit">Request Driver</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">All drivers are already in your requests or assigned.</p>
            @endif
        </div>
    </div>
</div>
@endsection
