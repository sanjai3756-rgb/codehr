@extends('layouts.app')

@section('content')

<h2>Payroll Report</h2>

<div class="card-box">

<div class="card">
<h3>Total Payroll Records</h3>
<h1>{{ $count }}</h1>
</div>

<div class="card">
<h3>Total Salary</h3>
<h1>₹{{ $total }}</h1>
</div>

</div>

@endsection