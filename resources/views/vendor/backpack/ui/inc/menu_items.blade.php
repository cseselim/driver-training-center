<Style>
    .d-print-none .list-inline-item:first-child {
        display: none;
    }
</Style>
{{-- This file is used for menu items by any Backpack v7 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>

@php
$user = backpack_user();
$userRole = $user->role ?? null;
@endphp

{{-- Admin Menu Items (Only for Admin users) --}}
@if($userRole === 'admin')
    <x-backpack::menu-item title="Admins" icon="la la-question" :link="backpack_url('admin')" />
    <x-backpack::menu-item title="Students" icon="la la-graduation-cap" :link="backpack_url('student')" />
    <x-backpack::menu-item title="Instructor" icon="la la-car" :link="backpack_url('driver')" />
    <x-backpack::menu-item title="Take Class" icon="la la-link" :link="backpack_url('driver-student')" />
    <x-backpack::menu-item title="Schedule Booking" icon="la la-link" :link="backpack_url('student-driver')" />
@endif

{{-- Driver Menu Items (Only for Driver users) --}}
@if($userRole === 'driver')
    <x-backpack::menu-item title="Take Class" icon="la la-link" :link="backpack_url('driver-student')" />
@endif

{{-- Student Menu Items (Only for Student users) --}}
@if($userRole === 'student')
    <x-backpack::menu-item title="Schedule Booking" icon="la la-link" :link="backpack_url('student-driver')" />
@endif

@if($userRole === 'admin' || $userRole === 'driver')
    <x-backpack::menu-item title="Schedules" icon="la la-link" :link="backpack_url('schedules')" />
@endif
