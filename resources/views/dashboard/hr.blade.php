@extends('layouts.app')

@section('content')

<h2 class="page-title">HR Dashboard</h2>

<div class="dashboard-grid">

<div class="dash-card blue">
<span>👨‍💼</span>
<h4>Employees</h4>
<h1>{{ $employees }}</h1>
</div>

<div class="dash-card green">
<span>📅</span>
<h4>Attendance</h4>
<h1>{{ $attendance }}</h1>
</div>

<div class="dash-card orange">
<span>📝</span>
<h4>Pending Leaves</h4>
<h1>{{ $leaves }}</h1>
</div>

</div>

@endsection