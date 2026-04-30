@extends('layouts.app')

@section('content')

<h2>Employee Dashboard</h2>

<div class="card-box">

<div class="card">
<h3>Welcome</h3>
<h1>{{ auth()->user()->name }}</h1>
</div>

<div class="card">
<h3>My Leaves</h3>
<h1>3</h1>
</div>

<div class="card">
<h3>Attendance</h3>
<h1>26</h1>
</div>

<div class="card">
<h3>Salary</h3>
<h1>₹15,000</h1>
</div>

</div>

@endsection