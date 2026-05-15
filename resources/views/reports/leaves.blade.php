@extends('layouts.app')

@section('content')

<div class="table-card">

    <div class="table-header">

        <div>
            <h2>Leave Report</h2>
            <p>Employee leave analytics</p>
        </div>

    </div>


    <div class="report-stats">

        <div class="report-card">
            <h3>Total Requests</h3>
            <h1>{{ $totalRequests }}</h1>
        </div>


        <div class="report-card">
            <h3>Approved</h3>
            <h1>{{ $approved }}</h1>
        </div>


        <div class="report-card">
            <h3>Pending</h3>
            <h1>{{ $pending }}</h1>
        </div>

    </div>
@endsection