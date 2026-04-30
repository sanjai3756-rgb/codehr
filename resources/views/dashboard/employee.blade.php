@extends('layouts.app')

@section('content')

<h2 class="page-title">Employee Dashboard</h2>

<div class="dashboard-grid">

<div class="dash-card blue">
<span>👋</span>
<h4>Welcome</h4>
<h1>{{ auth()->user()->name }}</h1>
</div>

<div class="dash-card green">
<span>⏰</span>
<h4>Punch</h4>
<h1><a href="/punch" style="color:white;">Open</a></h1>
</div>

<div class="dash-card orange">
<span>📝</span>
<h4>Leaves</h4>
<h1><a href="/my-leaves" style="color:white;">View</a></h1>
</div>

</div>

@endsection