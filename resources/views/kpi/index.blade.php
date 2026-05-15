@extends('layouts.app')

@section('content')

<div class="main">

    <div class="kpi-container">

        <div class="table-card">

            <div class="table-header">

                <div>

                    <h2>
                        Employee KPI
                    </h2>

                    <p>
                        All employee KPI performance
                    </p>

                </div>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>S.No</th>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Designation</th>

                        <th>Month</th>

                        <th>Total</th>

                        <th>Action</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($employees as $key => $employee)

                    <tr>

                        <td>
                            {{ $key + 1 }}
                        </td>


                        <td>

                            @if($employee->photo)

                                <img src="{{ asset('uploads/users/'.$employee->photo) }}"
                                     width="45"
                                     height="45"
                                     style="border-radius:50%;object-fit:cover;">

                            @endif

                        </td>


                        <td>

                            {{ $employee->name }}

                        </td>


                        <td>

                            <span class="role-badge">

                                {{ $employee->designation->designation_name ?? '-' }}

                            </span>

                        </td>


                        <td>

                            {{ date('F Y') }}

                        </td>


                        <td>

                            <span class="score-badge">

                                {{ $employee->kpi_total ?? 0 }}/100

                            </span>

                        </td>


                        <td>

                            <a href="{{ route('kpi.evaluate',$employee->id) }}"
                               class="edit-btn">

                                Evaluate

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="empty-text">

                            No Employees Found

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection