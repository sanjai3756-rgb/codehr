@extends('layouts.app')

@section('content')

<div class="main">

    <div class="kpi-container">

        <div class="table-card">

            <div class="table-header">

                <div>

                    <h2>
                        KPI Reports
                    </h2>

                    <p>
                        Monthly employee KPI reports
                    </p>

                </div>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>S.No</th>

                        <th>Employee</th>

                        <th>Designation</th>

                        <th>Month</th>

                        <th>Total Score</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($reports as $key => $report)

                    <tr>

                        <td>
                            {{ $key + 1 }}
                        </td>


                        <td>

                            {{ $report->employee->name ?? '-' }}

                        </td>


                        <td>

                            <span class="role-badge">

                                {{ $report->employee->designation->designation_name ?? '-' }}

                            </span>

                        </td>


                        <td>

                            {{ date('F', mktime(0,0,0,$report->month,1)) }}

                            {{ $report->year }}

                        </td>


                        <td>

                            <span class="score-badge">

                                {{ $report->total_score }}/100

                            </span>

                        </td>


                        <td>

                            @if($report->total_score >= 80)

                                <span class="status-success">
                                    Excellent
                                </span>

                            @elseif($report->total_score >= 60)

                                <span class="status-warning">
                                    Good
                                </span>

                            @else

                                <span class="status-danger">
                                    Needs Improvement
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="empty-text">

                            No KPI Reports Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection