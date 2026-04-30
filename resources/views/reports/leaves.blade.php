@extends('layouts.app')

@section('content')

<h2>Leave Report</h2>

<div class="card-box">

<div class="card">
<h3>Pending</h3>
<h1>{{ $pending }}</h1>
</div>

<div class="card">
<h3>Approved</h3>
<h1>{{ $approved }}</h1>
</div>

<div class="card">
<h3>Rejected</h3>
<h1>{{ $rejected }}</h1>
</div>

</div>

@endsection