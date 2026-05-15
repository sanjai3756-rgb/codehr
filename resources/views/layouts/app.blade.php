<!DOCTYPE html>
<html>

<head>

    <title>HRMS</title>

    @php
        $setting = \App\Models\Setting::first();
    @endphp

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/form.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/employee.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/buttons.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dark.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/settings.css') }}?v={{ time() }}">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- THEME -->
    <style>

        :root{

            --theme-color:
            {{ $setting->theme_color ?? '#2563eb' }};

            --font-family:
            '{{ $setting->font_family ?? 'Poppins' }}';

        }

        body{

            font-family:var(--font-family);
        }

    </style>

</head>

<body>

<!-- TRANSPARENT LOADER -->

<div id="pageLoader">

    <div class="mini-loader">

        @php
            $setting = \App\Models\Setting::first();
        @endphp


        @if($setting && $setting->logo)

            <img src="{{ asset('uploads/settings/'.$setting->logo) }}"
                 class="mini-loader-logo">

        @endif


        <div class="loader-line">

            <span></span>

            <span></span>

            <span></span>

        </div>

    </div>

</div>


<!-- SIDEBAR -->
<div class="sidebar">


    <!-- LOGO -->
    <div class="logo">

        @if($setting && $setting->logo)

            <img src="{{ asset('uploads/settings/'.$setting->logo) }}"
                 width="50"
                 style="border-radius:12px;margin-bottom:10px;">

        @endif


        <h2>

            {{ $setting->website_name ?? 'CodeHR' }}

        </h2>

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

    <button class="dropdown-btn">

        <div>

            <i class="fa-solid fa-users"></i>

            <span>Users</span>

        </div>

        <i class="fa-solid fa-chevron-down arrow"></i>

    </button>


    <div class="dropdown-container
        {{ request()->is('users*') ? 'show' : '' }}">

        <a href="/users">

            <i class="fa-solid fa-user"></i>

            <span>All Staffs</span>

        </a>

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



    <!-- KPI MANAGEMENT -->

    <button class="dropdown-btn">

        <div>

            <i class="fa-solid fa-chart-line"></i>

            <span>KPI Management</span>

        </div>

        <i class="fa-solid fa-chevron-down arrow"></i>

    </button>


    <div class="dropdown-container
        {{ request()->is('kpi*') ? 'show' : '' }}">

        <a href="{{ route('kpi.dashboard') }}">

            <i class="fa-solid fa-chart-pie"></i>

            <span>KPI Dashboard</span>

        </a>


        <a href="{{ route('kpi.index') }}">

            <i class="fa-solid fa-users"></i>

            <span>Employee KPI</span>

        </a>


        <a href="{{ route('kpi.reports') }}">

            <i class="fa-solid fa-file-lines"></i>

            <span>KPI Reports</span>

        </a>

    </div>



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

    <button class="dropdown-btn">

        <div>

            <i class="fa-solid fa-calendar-days"></i>

            <span>Leaves</span>

        </div>

        <i class="fa-solid fa-chevron-down arrow"></i>

    </button>


    <div class="dropdown-container">

        <a href="/leaves">

            <i class="fa-solid fa-paper-plane"></i>

            <span>Leave Requests</span>

        </a>


        <a href="/leave-types">

            <i class="fa-solid fa-layer-group"></i>

            <span>Leave Types</span>

        </a>


        <a href="/leave-settings">

            <i class="fa-solid fa-gear"></i>

            <span>Approval Settings</span>

        </a>

    </div>

    @endcan



    <!-- REPORTS -->

    @can('view reports')

    <button class="dropdown-btn">

        <div>

            <i class="fa-solid fa-chart-column"></i>

            <span>Reports</span>

        </div>

        <i class="fa-solid fa-chevron-down arrow"></i>

    </button>


    <div class="dropdown-container">

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



    <!-- SETTINGS -->

    <a href="/settings">

        <div>

            <i class="fa-solid fa-gear"></i>

            <span>Settings</span>

        </div>

    </a>



    <!-- EMPLOYEE PANEL -->

    @role('employee')

    <a href="/profile">

        <div>

            <i class="fa-solid fa-user"></i>

            <span>My Profile</span>

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
                {{ auth()->check() ? auth()->user()->name : 'Guest' }}

            </h3>

        </div>


        <!-- USER DROPDOWN -->

        <div class="user-dropdown">




            <div class="user-menu"
                 id="userDropdownMenu">

                <a href="/profile">


                    

                </a>


                <a href="/settings">


                    

                </a>


                <a href="/logout">



                </a>

            </div>

        </div>

    </div>



    <!-- CONTENT -->
    <div class="content">

        @yield('content')

    </div>

</div>



<!-- DROPDOWN SCRIPT -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | SIDEBAR DROPDOWN
    |--------------------------------------------------------------------------
    */

    const dropdownBtns =
        document.querySelectorAll('.dropdown-btn');

    dropdownBtns.forEach(btn => {

        btn.addEventListener('click', function (e) {

            e.preventDefault();

            e.stopPropagation();

            const dropdown =
                this.nextElementSibling;

            document
                .querySelectorAll('.dropdown-container')
                .forEach(menu => {

                    if(menu !== dropdown){

                        menu.classList.remove('show');

                    }

                });

            dropdown.classList.toggle('show');

        });

    });



    /*
    |--------------------------------------------------------------------------
    | USER DROPDOWN
    |--------------------------------------------------------------------------
    */

    const userBtn =
        document.getElementById('userDropdownBtn');

    const userMenu =
        document.getElementById('userDropdownMenu');


    if(userBtn){

        userBtn.addEventListener('click', function (e) {

            e.preventDefault();

            e.stopPropagation();

            userMenu.classList.toggle(
                'show-user-menu'
            );

        });

    }



    /*
    |--------------------------------------------------------------------------
    | OUTSIDE CLICK CLOSE
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function () {

        document
            .querySelectorAll('.dropdown-container')
            .forEach(menu => {

                menu.classList.remove('show');

            });

        if(userMenu){

            userMenu.classList.remove(
                'show-user-menu'
            );

        }

    });

});

</script>



<!-- TOAST -->

<script>

setTimeout(() => {

    let toast =
        document.getElementById('toast');

    if(toast){

        toast.style.transition = "0.5s";

        toast.style.opacity = "0";

        toast.style.transform =
            "translateX(100%)";

        setTimeout(() => {

            toast.remove();

        }, 500);

    }

}, 3000);

</script>


<script>

window.addEventListener('load', function(){

    const loader =
        document.getElementById('pageLoader');

    setTimeout(() => {

        loader.style.opacity = '0';

        loader.style.visibility = 'hidden';

        loader.style.pointerEvents = 'none';

    }, 500);

});

</script>
</body>

</html>