@extends('layouts.app')

@section('content')

<h2>Dashboard</h2>

<div class="card-box">

<div class="card">
<h3>Total Employees</h3>
<h1>{{ $totalEmployees }}</h1>
</div>

<div class="card">
<h3>Present Today</h3>
<h1>{{ $presentToday }}</h1>
</div>

<div class="card">
<h3>Pending Leaves</h3>
<h1>{{ $pendingLeaves }}</h1>
</div>

<div class="card">
<h3>Total Payroll</h3>
<h1>{{ $monthlyPayroll }}</h1>
</div>

</div>

@endsection