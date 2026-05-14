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

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <!-- LOGO -->
    <div class="logo">

        <h2>HRMS</h2>

    </div>


    <!-- DASHBOARD -->
    <a href="/dashboard"
       class="{{ request()->is('dashboard') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-house"></i>

            <span>Dashboard</span>

        </div>

    </a>



    <!-- USERS -->
    @can('manage users')

    <button class="dropdown-btn
        {{ request()->is('users*') || request()->is('permissions*') ? 'active' : '' }}"
        onclick="toggleMenu('userMenu')">

        <div>

            <i class="fa-solid fa-users"></i>

            <span>Users</span>

        </div>

        <i class="fa-solid fa-chevron-down arrow"></i>

    </button>

    <div id="userMenu"
         class="dropdown-container
         {{ request()->is('users*') || request()->is('permissions*') ? 'show' : '' }}">

        <a href="/users"
           class="{{ request()->is('users*') ? 'active' : '' }}">

            <i class="fa-solid fa-user"></i>

            <span>All Users</span>

        </a>


        @can('manage permissions')

        <a href="/permissions?user_id={{ auth()->id() }}"
           class="{{ request()->is('permissions*') ? 'active' : '' }}">

            <i class="fa-solid fa-key"></i>

            <span>Permissions</span>

        </a>

        @endcan

    </div>

    @endcan



    <!-- DEPARTMENTS -->
    @can('manage departments')

    <a href="/departments"
       class="{{ request()->is('departments*') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-building"></i>

            <span>Departments</span>

        </div>

    </a>

    @endcan



    <!-- DESIGNATIONS -->
    @can('manage designations')

    <a href="/designations"
       class="{{ request()->is('designations*') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-id-badge"></i>

            <span>Designations</span>

        </div>

    </a>

    @endcan



    <!-- EMPLOYEES -->
    @can('manage employees')

    <a href="/employees"
       class="{{ request()->is('employees*') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-user-group"></i>

            <span>Employees</span>

        </div>

    </a>

    @endcan



    <!-- ATTENDANCE -->
    @can('manage attendance')

    <a href="/attendances"
       class="{{ request()->is('attendances*') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-calendar-check"></i>

            <span>Attendance</span>

        </div>

    </a>

    @endcan



    <!-- KPI -->
    @can('manage kpi')

    <a href="/kpi-points"
       class="{{ request()->is('kpi-points') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-chart-line"></i>

            <span>KPI Points</span>

        </div>

    </a>

    @endcan



    <!-- PAYROLL -->
    @can('manage payroll')

    <a href="/payrolls"
       class="{{ request()->is('payrolls*') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-money-bill-wave"></i>

            <span>Payroll</span>

        </div>

    </a>

    @endcan



    <!-- LEAVES -->
    @can('manage leaves')

    <a href="/leaves"
       class="{{ request()->is('leaves*') ? 'active' : '' }}">

        <div>

            <i class="fa-solid fa-plane-departure"></i>

            <span>Leaves</span>

        </div>

    </a>

    @endcan



    <!-- REPORTS -->
    @can('view reports')

    <button class="dropdown-btn
        {{ request()->is('reports*') ? 'active' : '' }}"
        onclick="toggleMenu('reportsMenu')">

        <div>

            <i class="fa-solid fa-chart-column"></i>

            <span>Reports</span>

        </div>

        <i class="fa-solid fa-chevron-down arrow"></i>

    </button>

    <div id="reportsMenu"
         class="dropdown-container
         {{ request()->is('reports*') ? 'show' : '' }}">

        <a href="/reports/attendance">

            <i class="fa-solid fa-file-lines"></i>

            <span>Attendance Report</span>

        </a>

        <a href="/reports/leaves">

            <i class="fa-solid fa-file-lines"></i>

            <span>Leave Report</span>

        </a>

        <a href="/reports/payroll">

            <i class="fa-solid fa-file-lines"></i>

            <span>Payroll Report</span>

        </a>

    </div>

    @endcan



    <!-- EMPLOYEE PANEL -->
    @role('employee')

    <a href="/profile">

        <div>

            <i class="fa-solid fa-user"></i>

            <span>My Profile</span>

        </div>

    </a>

    <a href="/my-attendance">

        <div>

            <i class="fa-solid fa-clock"></i>

            <span>My Attendance</span>

        </div>

    </a>

    <a href="/punch">

        <div>

            <i class="fa-solid fa-hand-pointer"></i>

            <span>Punch</span>

        </div>

    </a>

    <a href="/apply-leave">

        <div>

            <i class="fa-solid fa-paper-plane"></i>

            <span>Apply Leave</span>

        </div>

    </a>

    <a href="/my-payslip">

        <div>

            <i class="fa-solid fa-file-invoice-dollar"></i>

            <span>Payslip</span>

        </div>

    </a>

    @endrole



    <!-- LOGOUT -->
    <a href="/logout"
       class="logout-btn">

        <i class="fa-solid fa-right-from-bracket"></i>

        <span>Logout</span>

    </a>

</div>



<!-- MAIN -->
<div class="main">

    <!-- NAVBAR -->
    <div class="navbar">

        <div class="nav-left">

            <h3>

                Welcome,
                {{ auth()->user()->name }}

            </h3>

        </div>

    </div>


    <!-- CONTENT -->
    <div class="content">

        @yield('content')

    </div>

</div>



<!-- SIDEBAR JS -->
<script>

function toggleMenu(menuId)
{
    document
        .getElementById(menuId)
        .classList
        .toggle("show");
}

</script>



<!-- TOAST -->
<script>

setTimeout(() => {

    let toast = document.getElementById('toast');

    if(toast){

        toast.style.transition = "0.5s";

        toast.style.opacity = "0";

        toast.style.transform = "translateX(100%)";

        setTimeout(() => {

            toast.remove();

        }, 500);

    }

}, 3000);

</script>

</body>
</html>