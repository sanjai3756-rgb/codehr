<!DOCTYPE html>
<html>
<head>
    <title >HRMS</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

{{-- <div class="sidebar">

    <h2>HRMS</h2>
 --}}

<div class="sidebar" id="sidebar">

<div class="logo">
<h2>HRMS</h2>
</div>

@php
$role = auth()->user()->role;
@endphp

{{-- ADMIN MENU --}}
@if($role == 'admin')

<a href="/admin/dashboard">Dashboard</a>
<a href="/employees"
class="{{ request()->is('employees*') ? 'active' : '' }}">
Employees
</a>
<a href="/departments">Departments</a>
<a href="/designations">Designations</a>
<a href="/attendances">Attendance</a>
<a href="/leaves">Leaves</a>
<a href="/payrolls">Payroll</a>
<a href="/users">Users</a>
<a href="/reports">Reports</a>

@endif

{{-- HR MENU --}}
@if($role == 'hr')

<a href="/hr/dashboard">Dashboard</a>
<a href="/employees"
class="{{ request()->is('employees*') ? 'active' : '' }}">
Employees
</a>
<a href="/attendances">Attendance</a>
<a href="/leaves">Leaves</a>
<a href="/payrolls">Payroll</a>

@endif

{{-- EMPLOYEE MENU --}}
@if($role == 'employee')

<a href="/employee/dashboard">Dashboard</a>
<a href="/profile">My Profile</a>
<a href="/my-attendance">My Attendance</a>
<a href="/punch">Punch</a>
<a href="/my-leaves">Apply Leave</a>
<a href="/my-payslip">Payslip</a>

@endif

</div>
<script>
document.getElementById('toggleBtn').addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('main').classList.toggle('expanded');
});

const darkBtn = document.getElementById('darkModeBtn');

if(localStorage.getItem('theme') === 'dark'){
    document.body.classList.add('dark-mode');
}

darkBtn.addEventListener('click', function(){

    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){
        localStorage.setItem('theme','dark');
    }else{
        localStorage.setItem('theme','light');
    }

});
</script>
</body>
</html>