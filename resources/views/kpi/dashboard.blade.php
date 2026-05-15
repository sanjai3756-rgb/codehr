@extends('layouts.app')

@section('content')

<div class="main">

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

        <div class="dashboard-grid">


            <!-- CARD -->

            <div class="dash-card">

                <div class="card-icon">

                    <i class="fa-solid fa-users"></i>

                </div>

                <div class="card-info">

                    <h4>
                        Total Employees
                    </h4>

                    <h1>
                        {{ $employees }}
                    </h1>

                </div>

            </div>



            <!-- CARD -->

            <div class="dash-card">

                <div class="card-icon">

                    <i class="fa-solid fa-chart-line"></i>

                </div>

                <div class="card-info">

                    <h4>
                        Evaluated This Month
                    </h4>

                    <h1>
                        {{ $evaluated }}
                    </h1>

                </div>

            </div>



            <!-- CARD -->

            <div class="dash-card">

                <div class="card-icon">

                    <i class="fa-solid fa-trophy"></i>

                </div>

                <div class="card-info">

                    <h4>
                        Top Performers
                    </h4>

                    <h1>
                        {{ $top }}
                    </h1>

                </div>

            </div>



            <!-- CARD -->

            <div class="dash-card">

                <div class="card-icon">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <div class="card-info">

                    <h4>
                        Pending Reviews
                    </h4>

                    <h1>
                        {{ $pending }}
                    </h1>

                </div>

            </div>

        </div>



        <!-- TOP EMPLOYEE TABLE -->

        <div class="table-card">

            <div class="table-header">

                <div>

                    <h2>
                        Top Employees
                    </h2>

                    <p>
                        Monthly KPI ranking performance
                    </p>

                </div>

            </div>



            <div class="table-responsive">

                <table>

                    <thead>

                        <tr>

                            <th>S.No</th>

                            <th>Employee</th>

                            <th>Designation</th>

                            <th>KPI Score</th>

                            <th>Status</th>

                        </tr>

                    </thead>



                    <tbody>

                        @forelse($topEmployees as $key => $employee)

                        <tr>

                            <td>

                                {{ $key + 1 }}

                            </td>



                            <td>

                                <div class="employee-info">

                                    @if($employee->photo)

                                        <img src="{{ asset('uploads/users/'.$employee->photo) }}"
                                             class="employee-img">

                                    @else

                                        <div class="employee-placeholder">

                                            {{ strtoupper(substr($employee->name,0,1)) }}

                                        </div>

                                    @endif



                                    <div>

                                        <strong>

                                            {{ $employee->name }}

                                        </strong>

                                    </div>

                                </div>

                            </td>



                            <td>

                                <span class="role-badge">

                                    {{ $employee->designation->designation_name ?? '-' }}

                                </span>

                            </td>



                            <td>

                                <span class="score-badge">

                                    {{ $employee->kpi_total ?? 0 }}/100

                                </span>

                            </td>



                            <td>

                                @if(($employee->kpi_total ?? 0) >= 80)

                                    <span class="status-success">

                                        Excellent

                                    </span>

                                @elseif(($employee->kpi_total ?? 0) >= 60)

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

                            <td colspan="5" class="empty-text">

                                No KPI Data Available

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection