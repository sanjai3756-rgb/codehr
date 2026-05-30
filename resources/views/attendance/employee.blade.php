
@extends('layouts.app')

@section('content')

<h1 style="color:red">
    ATTENDANCE PAGE LOADED
</h1>
<div class="table-card">

    <h2>My Attendance</h2>
    @if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="alert alert-danger">

    {{ session('error') }}

</div>

@endif

    <div style="margin-bottom:20px;">

        <form
            action="{{ route('attendances.checkin') }}"
            method="POST"
            style="display:inline-block;"
        >
            @csrf

            <button
                type="submit"
                class="save-btn"
            >
                Check In
            </button>

        </form>

        <form
            action="{{ route('attendances.checkout') }}"
            method="POST"
            style="display:inline-block;margin-left:10px;"
        >
            @csrf

            <button
                type="submit"
                class="save-btn"
            >
                Check Out
            </button>

        </form>

    </div>

    <table>

        <thead>

            <tr>

                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Working Hours</th>

            </tr>

        </thead>

        <tbody>

            @forelse($attendances as $attendance)

            <tr>

                <td>{{ $attendance->date }}</td>

                <td>{{ $attendance->check_in ?? '-' }}</td>

                <td>{{ $attendance->check_out ?? '-' }}</td>

                <td>{{ $attendance->working_hours }} Hours</td>

            </tr>

            @empty

            <tr>

                <td colspan="4">

                    No Attendance Records Found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection