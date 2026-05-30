@extends('layouts.app')

@section('content')

<div class="kpimain">

    <div class="kpi-dashboard-wrapper">


        <!-- PAGE HEADER -->

        <div class="kpi-top-header">

            <div>

                <h1 class="page-title">
                    KPI Dashboard
                </h1>

                <p class="page-subtitle">
                    Monitor employee performance and KPI analytics
                </p>

            </div>

        </div>



        <!-- KPI STATS -->

<!-- TOP 3 & LOWEST 3 -->

<div class="dashboard-grid">

    <div class="table-card">

        <div class="table-header">

            <h2>🏆 Top 3 Performers</h2>

        </div>

        @foreach($highestEmployees as $report)

        <div class="rank-item">

            <span>
                {{ $loop->iteration }}.
                {{ $report->employee->name ?? '-' }}
            </span>

            <strong>
                {{ number_format($report->total_score,2) }}/100
            </strong>

        </div>

        @endforeach

    </div>



    <div class="table-card">

        <div class="table-header">

            <h2>📉 Bottom 3 Performers</h2>

        </div>

        @foreach($lowestEmployees as $report)

        <div class="rank-item">

            <span>
                {{ $loop->iteration }}.
                {{ $report->employee->name ?? '-' }}
            </span>

            <strong>
                {{ number_format($report->total_score,2) }}/100
            </strong>

        </div>

        @endforeach

    </div>

</div>
@endsection