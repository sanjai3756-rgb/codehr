@extends('layouts.app')

@section('content')

<div class="table-card">

    <div class="table-header">

        <div>
            <h2>Payroll Report</h2>
            <p>Employee payroll analytics</p>
        </div>

    </div>


    <div class="report-stats">

        <div class="report-card">
            <h3>Total Payroll</h3>
            <h1>₹ {{ number_format($totalPayroll) }}</h1>
        </div>


        <div class="report-card">
            <h3>Total Bonus</h3>
            <h1>₹ {{ number_format($totalBonus) }}</h1>
        </div>


        <div class="report-card">
            <h3>Employees Paid</h3>
            <h1>{{ $employeesPaid }}</h1>
        </div>

    </div>
@endsection