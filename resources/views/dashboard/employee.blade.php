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
</div>

<div class="dash-card orange">
<span>📝</span>
<h4>Leaves</h4>
</div>

</div>

@endsection