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
    <link rel="stylesheet"href="{{ asset('assets/css/payroll.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/settings.css') }}?v={{ time() }}">
    <link rel="stylesheet"href="{{ asset('assets/css/leave.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shift.css') }}">

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
            '{{ $setting->font_family ?? 'poppins' }}';

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


<button class="dropdown-btn">

    <div>

        <i class="fa-solid fa-calendar-check"></i>

        <span>Attendance</span>

    </div>


    <i class="fa-solid fa-chevron-down arrow"></i>


</button>



<div class="dropdown-container
{{ request()->is('attendance*') ? 'show' : '' }}">




    <a href="{{ route('attendance.settings') }}">

        <i class="fa-solid fa-gear"></i>

        <span>Attendance Settings</span>

    </a>



</div>


@endcan

  
<div class="nav-item">

    <a 
    href="{{ route('shifts.index') }}"
    class="nav-link">

        <i class="fa fa-clock"></i>

        <span>
            Shift Management
        </span>

    </a>

</div>



<!-- KPI MANAGEMENT -->

@if(auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->canAny(['kpi.evaluate','manage kpi'])))

<button class="dropdown-btn">

    <div>

        <i class="fa-solid fa-chart-line"></i>

        <span>KPI Management</span>

    </div>

    <i class="fa-solid fa-chevron-down"></i>

</button>

<div class="dropdown-container">

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

    <a href="{{ route('kpi.assignments') }}">

        <i class="fa-solid fa-user-check"></i>

        <span>KPI Assignments</span>

    </a>

</div>

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

     <a href="{{ route('leave.approval') }}">

         <i class="fa-solid fa-gear"></i>

    Approval Settings

</a>



  

<a href="{{ route('holidays.index') }}">

    <i class="fa-solid fa-calendar-days"></i>

    Holidays

</a>



<a href="{{ route('leave.settings') }}">

        <i class="fa-solid fa-gear"></i>


    Leave Settings

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
@can('manage settings')

    <a href="/settings">

        <div>

            <i class="fa-solid fa-gear"></i>

            <span>Settings</span>

        </div>

    </a>
@endcan





    <!-- EMPLOYEE PANEL -->

@role('employee')

<a href="/attendance/my">

    <div>

        <i class="fa-solid fa-calendar-check"></i>

        <span>My Attendance</span>

    </div>

</a>


<a href="/leave/apply">

    <div>

        <i class="fa-solid fa-paper-plane"></i>

        <span>Apply Leave</span>

    </div>

</a>


<a href="/leave/my">

    <div>

        <i class="fa-solid fa-calendar-days"></i>

        <span>My Leaves</span>

    </div>

</a>


<a href="/employee/kpi">

    <div>

        <i class="fa-solid fa-chart-line"></i>

        <span>My KPI</span>

    </div>

</a>


<a href="/profile">

    <div>

        <i class="fa-solid fa-user"></i>

        <span>My Profile</span>

    </div>

</a>

@endrole




<!-- LOGOUT -->

<form
method="POST"
action="{{ route('logout') }}"
class="sidebar-logout"
>

@csrf


<button
type="submit"
>

    <div>

        <i class="fa-solid fa-right-from-bracket"></i>

        <span>Logout</span>

    </div>


</button>


</form>

</div>
{{-- SIDEBAR CLOSE --}}



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


                {{-- <a href="/settings"> --}}


                    

            </div>

        </div>

    </div>



    <!-- CONTENT -->
    <div class="content">

        @yield('content')

    </div>

</div>



<!-- DROPDOWN SCRIPT -->

<!-- ALL SCRIPTS -->

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

        userBtn.addEventListener('click', function(e){

            e.preventDefault();

            e.stopPropagation();

            userMenu.classList.toggle(
                'show-user-menu'
            );

        });

    }



    /*
    |--------------------------------------------------------------------------
    | OUTSIDE CLICK
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



    /*
    |--------------------------------------------------------------------------
    | KPI SEARCH
    |--------------------------------------------------------------------------
    */

    const search =
        document.getElementById(
            'employeeSearch'
        );



    const select =
        document.getElementById(
            'employeeSelect'
        );



    if(search && select){

        search.addEventListener('keyup', function(){

            let value =
                this.value.toLowerCase();



            Array.from(
                select.options
            ).forEach(option => {

                let text =
                    option.text.toLowerCase();



                option.style.display =
                    text.includes(value)
                    ? ''
                    : 'none';

            });

        });

    }



    /*
    |--------------------------------------------------------------------------
    | KPI CALCULATION
    |--------------------------------------------------------------------------
    */

    function calculateKPI(){

        let grandTotal = 0;



        document.querySelectorAll(
            '.kpi-question-row'
        ).forEach(row => {

            let week12 =
                parseFloat(
                    row.querySelector('.week12')?.value
                ) || 0;



            let week34 =
                parseFloat(
                    row.querySelector('.week34')?.value
                ) || 0;



            let final =
                ((week12 + week34) / 2);



            let finalBox =
                row.querySelector('.final-box');



            if(finalBox){

                finalBox.value =
                    final.toFixed(2);

            }



            grandTotal += final;

        });



        let finalScore =
            document.getElementById(
                'finalScore'
            );



        if(finalScore){

            finalScore.innerText =
                grandTotal.toFixed(2);

        }

    }



    document.querySelectorAll(
        '.week12,.week34'
    ).forEach(input => {

        input.addEventListener(
            'input',
            calculateKPI
        );

    });

});



/*
|--------------------------------------------------------------------------
| PAGE LOADER
|--------------------------------------------------------------------------
*/

window.addEventListener('load', function(){

    const loader =
        document.getElementById('pageLoader');

    if(loader){

        setTimeout(() => {

            loader.style.opacity = '0';

            loader.style.visibility = 'hidden';

            loader.style.pointerEvents = 'none';

        }, 500);

    }

});



/*
|--------------------------------------------------------------------------
| TOAST
|--------------------------------------------------------------------------
*/

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

const searchInput =
    document.getElementById(
        'employeeSearch'
    );



const dropdown =
    document.getElementById(
        'employeeDropdown'
    );



searchInput.addEventListener('focus', function(){

    dropdown.classList.add(
        'show-dropdown'
    );

});



searchInput.addEventListener('keyup', function(){

    let value =
        this.value.toLowerCase();



    document.querySelectorAll(
        '.employee-card'
    ).forEach(card => {

        let text =
            card.innerText.toLowerCase();



        card.style.display =
            text.includes(value)
            ? 'block'
            : 'none';

    });

});



document.addEventListener('click', function(e){

    if(
        !searchInput.contains(e.target)
        &&
        !dropdown.contains(e.target)
    ){

        dropdown.classList.remove(
            'show-dropdown'
        );

    }

});

</script>

<script>

setTimeout(function(){

    let toast =
    document.querySelector('.toast-success');


    if(toast){

        toast.style.opacity = '0';

        setTimeout(function(){

            toast.remove();

        },500);

    }


},3000);


</script>


</body>

</html>