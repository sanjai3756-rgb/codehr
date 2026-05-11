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

    {{-- ADMIN --}}
    @role('admin')

        <a href="/dashboard">Dashboard</a>

        {{-- USERS --}}
        <button class="dropdown-btn"
                onclick="toggleMenu('userMenu')">

            Users ⌄

        </button>

        <div id="userMenu" class="dropdown-container">

            <a href="/users">Users</a>

            <a href="/permissions">Permissions</a>

        </div>


        <a href="/departments">Departments</a>

        <a href="/designations">Designation</a>

        <a href="/attendances">Attendance</a>

        <a href="/payrolls">Payroll</a>

        <a href="/leaves">Leaves</a>


        {{-- REPORTS --}}
        <button class="dropdown-btn"
                onclick="toggleMenu('reportsMenu')">

            Reports ⌄

        </button>

        <div id="reportsMenu" class="dropdown-container">

            <a href="/reports/attendance">
                Attendance Report
            </a>

            <a href="/reports/leaves">
                Leave Report
            </a>

            <a href="/reports/payroll">
                Payroll Report
            </a>

        </div>

    @endrole



    {{-- HR --}}
    @role('hr')

        <a href="/dashboard">Dashboard</a>

        <a href="/employees">Employees</a>

        <a href="/attendances">Attendance</a>

        <a href="/payrolls">Payroll</a>

        <a href="/leaves">Leaves</a>

    @endrole



    {{-- EMPLOYEE --}}
    @role('employee')

        <a href="/dashboard">Dashboard</a>

        <a href="/profile">My Profile</a>

        <a href="/my-attendance">My Attendance</a>

        <a href="/punch">Punch</a>

        <a href="/apply-leave">Apply Leave</a>

        <a href="/my-payslip">Payslip</a>

    @endrole


    <a href="/logout" class="logout-btn">
        Logout
    </a>

</div>
<!-- MAIN CONTENT -->
<div class="main">

    <!-- TOP NAVBAR -->
    <div class="navbar">
        <div class="nav-left">
            <h3>Welcome, {{ auth()->user()->name }}</h3>
        </div>

        {{-- <div class="nav-right">
            <a href="/logout" class="logout-btn">Logout</a>
        </div> --}}
    </div>

    <!-- PAGE CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</div>


<script>

function toggleUserMenu() {

    document.getElementById("userMenu")
            .classList.toggle("show");

}

function toggleReportsMenu() {

    document.getElementById("reportsMenu")
            .classList.toggle("show");

}
function toggleMenu(menuId)
{
    document
        .getElementById(menuId)
        .classList
        .toggle("show");
}


</script>
</body>
</html>