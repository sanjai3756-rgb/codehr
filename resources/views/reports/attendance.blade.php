@extends('layouts.app')

@section('content')

<div class="table-card">

    <div class="table-header">

        <div>
            <h2>Attendance Report</h2>
            <p>Employee attendance analytics</p>
        </div>

    </div>


    <div class="report-stats">

        <div class="report-card">
            <h3>Total Employees</h3>
            <h1>{{ $totalEmployees }}</h1>
        </div>


        <div class="report-card">
            <h3>Present Today</h3>
            <h1>{{ $presentToday }}</h1>
        </div>


        <div class="report-card">
            <h3>Absent Today</h3>
            <h1>{{ $absentToday }}</h1>
        </div>

    </div>
@endsection