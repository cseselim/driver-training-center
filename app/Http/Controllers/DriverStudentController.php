<?php

namespace App\Http\Controllers;

use App\Models\DriverStudent;
use App\Models\User;
use Illuminate\Http\Request;

class DriverStudentController extends Controller
{
    /**
     * Student views available drivers and sends request
     */
    public function studentAvailableDrivers()
    {
        $user = auth()->user();

        // Get drivers not already requested
        $availableDrivers = User::where('role', 'driver')
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('driver_id')
                    ->from('driver_student')
                    ->where('student_id', $user->id);
            })
            ->get();

        // Get existing requests
        $myRequests = DriverStudent::where('student_id', $user->id)
            ->with('driver')
            ->get();

        return view('driver-student.student-dashboard', compact('availableDrivers', 'myRequests'));
    }

    /**
     * Student sends request to driver
     */
    public function studentRequestDriver(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $user = auth()->user();

        // Check if request already exists
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

    /**
     * Driver views available students and can select them
     */
    public function driverAvailableStudents()
    {
        $user = auth()->user();

        // Get students not already assigned
        $availableStudents = User::where('role', 'student')
            ->whereNotIn('id', function ($query) use ($user) {
                $query->select('student_id')
                    ->from('driver_student')
                    ->where('driver_id', $user->id);
            })
            ->get();

        // Get existing assignments
        $myStudents = DriverStudent::where('driver_id', $user->id)
            ->with('student')
            ->get();

        return view('driver-student.driver-dashboard', compact('availableStudents', 'myStudents'));
    }

    /**
     * Driver selects a student
     */
    public function driverSelectStudent(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
        ]);

        $user = auth()->user();

        // Check if already exists
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

    /**
     * Student accepts driver request
     */
    public function studentAcceptDriver(Request $request, $assignmentId)
    {
        $assignment = DriverStudent::findOrFail($assignmentId);

        // Verify this is the student
        if ($assignment->student_id != auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $assignment->update(['status' => 'accepted']);
        return back()->with('success', 'Request accepted');
    }

    /**
     * Student rejects driver request
     */
    public function studentRejectDriver(Request $request, $assignmentId)
    {
        $assignment = DriverStudent::findOrFail($assignmentId);

        // Verify this is the student
        if ($assignment->student_id != auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $assignment->delete();
        return back()->with('success', 'Request rejected');
    }

    /**
     * Driver removes student
     */
    public function driverRemoveStudent(Request $request, $assignmentId)
    {
        $assignment = DriverStudent::findOrFail($assignmentId);

        // Verify this is the driver
        if ($assignment->driver_id != auth()->id()) {
            return back()->with('error', 'Unauthorized');
        }

        $assignment->delete();
        return back()->with('success', 'Student removed');
    }
}
