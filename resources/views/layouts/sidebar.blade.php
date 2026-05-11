{{-- ADMIN SIDEBAR --}}

@role('admin')

<ul class="sidebar">

    {{-- Dashboard --}}
    <li>
        <a href="/dashboard">Dashboard</a>
    </li>


    {{-- Users Dropdown --}}
    <li class="menu-title">
        Users
    </li>

    <li>
        <a href="/users">Users</a>
    </li>

    <li>
        <a href="/permissions">Permissions</a>
    </li>


    {{-- Departments --}}
    <li>
        <a href="/departments">Departments</a>
    </li>


    {{-- Designations --}}
    <li>
        <a href="/designations">Designation</a>
    </li>


    {{-- Attendance --}}
    <li>
        <a href="/attendances">Attendance</a>
    </li>


    {{-- Payroll --}}
    <li>
        <a href="/payrolls">Payroll</a>
    </li>


    {{-- Leaves --}}
    <li>
        <a href="/leaves">Leaves</a>
    </li>


    {{-- Reports Dropdown --}}
    <li class="menu-title">
        Reports
    </li>

    <li>
        <a href="/reports/attendance">
            Attendance Report
        </a>
    </li>

    <li>
        <a href="/reports/leaves">
            Leave Report
        </a>
    </li>

    <li>
        <a href="/reports/payroll">
            Payroll Report
        </a>
    </li>


    {{-- Logout --}}
    <li>
        <a href="/logout">Logout</a>
    </li>

</ul>

@endrole