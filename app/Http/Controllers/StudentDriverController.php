<?php

namespace App\Http\Controllers;

use App\Models\DriverStudent;
use App\Models\User;
use Illuminate\Http\Request;

class StudentDriverController extends Controller
{
    /**
     * Student views available drivers and sends request
     */
    public function studentAvailableDrivers()
    {
        $user = auth()->user();

        $availableDrivers = User::where('role', 'driver')
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('driver_id')
                    ->from('driver_student')
                    ->where('student_id', $user->id);
            })
            ->get();

        $myRequests = DriverStudent::where('student_id', $user->id)
            ->with('driver')
            ->get();

        return view('student-driver.student-dashboard', compact('availableDrivers', 'myRequests'));
    }

    public function studentRequestDriver(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $user = auth()->user();

        $exists = DriverStudent::where('student_id', $user->id)
            ->where('driver_id', $validated['driver_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Request already exists');
        }

        DriverStudent::create([
            'driver_id' => $validated['driver_id'],
            'student_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Request sent to driver');
    }

    public function driverAvailableStudents()
    {
        $user = auth()->user();

        $availableStudents = User::where('role', 'student')
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('student_id')
                    ->from('driver_student')
                    ->where('driver_id', $user->id);
            })
            ->get();

        $myStudents = DriverStudent::where('driver_id', $user->id)
            ->with('student')
            ->get();

        return view('student-driver.driver-dashboard', compact('availableStudents', 'myStudents'));
    }

    public function driverSelectStudent(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $user = auth()->user();

        $exists = DriverStudent::where('driver_id', $user->id)
            ->where('student_id', $validated['student_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Student already assigned');
        }

        DriverStudent::create([
            'driver_id' => $user->id,
            'student_id' => $validated['student_id'],
            'status' => 'accepted',
        ]);

        return back()->with('success', 'Student assigned successfully');
    }

    public function studentAcceptDriver(Request $request, $assignmentId)
    {
        $assignment = DriverStudent::findOrFail($assignmentId);

        if ($assignment->student_id != auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $assignment->update(['status' => 'accepted']);
        return back()->with('success', 'Request accepted');
    }

    public function studentRejectDriver(Request $request, $assignmentId)
    {
        $assignment = DriverStudent::findOrFail($assignmentId);

        if ($assignment->student_id != auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $assignment->delete();
        return back()->with('success', 'Request rejected');
    }

    public function driverRemoveStudent(Request $request, $assignmentId)
    {
        $assignment = DriverStudent::findOrFail($assignmentId);

        if ($assignment->driver_id != auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $assignment->delete();
        return back()->with('success', 'Student removed');
    }
}
