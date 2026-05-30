@extends('layouts.app')

@section('content')

<div class="table-card">

    <h2>Attendance Management</h2>

    <table>

        <thead>

            <tr>

                <th>Employee</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Working Hours</th>
                <th>Salary</th>

            </tr>

        </thead>

        <tbody>

            @forelse($attendances as $attendance)

            <tr>

                <td>
                    {{ $attendance->employee->name ?? '-' }}
                </td>

                <td>
                    {{ $attendance->date }}
                </td>

                <td>
                    {{ $attendance->check_in ?? '-' }}
                </td>

                <td>
                    {{ $attendance->check_out ?? '-' }}
                </td>

                <td>
                    {{ $attendance->working_hours }}
                </td>

                <td>
                    ₹{{ number_format($attendance->salary_amount,2) }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6">
                    No Attendance Records Found
                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection