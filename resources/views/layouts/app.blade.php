<!DOCTYPE html>
<html>
<head>
    <title>HRMS</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/employee.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dark.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="sidebar" id="sidebar">

    <div class="logo">
        <h2>HRMS</h2>
    </div>

    @php
        $role = auth()->user()->role;
    @endphp

    {{-- ADMIN MENU --}}
    @if($role == 'admin')

        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="/employees" class="{{ request()->is('employees*') ? 'active' : '' }}">
            Employees
        </a>

        <a href="/departments" class="{{ request()->is('departments*') ? 'active' : '' }}">
            Departments
        </a>

        <a href="/designations" class="{{ request()->is('designations*') ? 'active' : '' }}">
            Designations
        </a>

        <a href="/attendances" class="{{ request()->is('attendances*') ? 'active' : '' }}">
            Attendance
        </a>

        <a href="/leaves" class="{{ request()->is('leaves*') ? 'active' : '' }}">
            Leaves
        </a>

        <a href="/payrolls" class="{{ request()->is('payrolls*') ? 'active' : '' }}">
            Payroll
        </a>

        <a href="javascript:void(0);" 
           onclick="toggleReport()" 
           class="dropdown-btn {{ request()->is('reports*') ? 'active' : '' }}">
            Reports ▼
        </a>

        <div id="reportMenu" class="dropdown-menu {{ request()->is('reports*') ? 'show' : '' }}">

            <a href="/reports/attendance" class="{{ request()->is('reports/attendance') ? 'active' : '' }}">
                Attendance Report
            </a>

            <a href="/reports/payroll" class="{{ request()->is('reports/payroll') ? 'active' : '' }}">
                Payroll Report
            </a>

            <a href="/reports/leaves" class="{{ request()->is('reports/leaves') ? 'active' : '' }}">
                Leave Report
            </a>

        </div>

    @endif


    {{-- HR MENU --}}
    @if($role == 'hr')

        <a href="/hr/dashboard" class="{{ request()->is('hr/dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="/employees" class="{{ request()->is('employees*') ? 'active' : '' }}">
            Employees
        </a>

        <a href="/attendances" class="{{ request()->is('attendances*') ? 'active' : '' }}">
            Attendance
        </a>

        <a href="/leaves" class="{{ request()->is('leaves*') ? 'active' : '' }}">
            Leaves
        </a>

        <a href="/payrolls" class="{{ request()->is('payrolls*') ? 'active' : '' }}">
            Payroll
        </a>

    @endif


    {{-- EMPLOYEE MENU --}}
    @if($role == 'employee')

        <a href="/employee/dashboard" class="{{ request()->is('employee/dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="/profile" class="{{ request()->is('profile') ? 'active' : '' }}">
            My Profile
        </a>

        <a href="/my-attendance" class="{{ request()->is('my-attendance') ? 'active' : '' }}">
            Attendance
        </a>

        <a href="/punch" class="{{ request()->is('punch') ? 'active' : '' }}">
            Punch
        </a>

        <a href="/apply-leave" class="{{ request()->is('apply-leave') ? 'active' : '' }}">
            Apply Leave
        </a>

        <a href="/my-payslip" class="{{ request()->is('my-payslip') ? 'active' : '' }}">
            Payslip
        </a>

    @endif

</div>


<!-- MAIN CONTENT -->
<div class="main">

    <!-- TOP NAVBAR -->
    <div class="navbar">
        <div class="nav-left">
            <h3>Welcome, {{ auth()->user()->name }}</h3>
        </div>

        <div class="nav-right">
            <a href="/logout" class="logout-btn">Logout</a>
        </div>
    </div>

    <!-- PAGE CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</div>


<script>
function toggleReport() {
    document.getElementById("reportMenu").classList.toggle("show");
}
</script>

</body>
</html>