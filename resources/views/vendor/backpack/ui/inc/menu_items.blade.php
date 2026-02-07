{{-- This file is used for menu items by any Backpack v7 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Admins" icon="la la-question" :link="backpack_url('admin')" />
<x-backpack::menu-item title="Students" icon="la la-graduation-cap" :link="backpack_url('student')" />
<x-backpack::menu-item title="Drivers" icon="la la-car" :link="backpack_url('driver')" />
<x-backpack::menu-item title="Driver-Student Assignments" icon="la la-link" :link="backpack_url('driver-student')" />
<x-backpack::menu-item title="Student-Driver Assignments" icon="la la-link" :link="backpack_url('student-driver')" />
