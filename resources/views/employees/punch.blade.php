@extends('layouts.app')

@section('content')

<div class="main-content">

    <h2>Punch In / Punch Out</h2>

    @if(session('success'))
        <div class="success-msg">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <p><strong>Date :</strong> {{ date('d-m-Y') }}</p>

        @if(!$today)

            <form action="/punch-in" method="POST">
                @csrf
                <button type="submit" class="btn-edit">
                    Punch In
                </button>
            </form>

        @else

            <p><strong>Status :</strong> {{ $today->status }}</p>

            <p><strong>Check In :</strong> {{ date('h:i A', strtotime($today->check_in)) }}</p>

            <p>
                <strong>Check Out :</strong>
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

                @if($today->check_out)
                    {{ date('h:i A', strtotime($today->check_out)) }}
                @else
                    Not Yet
                @endif
            </p>

            @if($today->check_in && $today->check_out)

                @php
                    $start = \Carbon\Carbon::parse($today->check_in);
                    $end   = \Carbon\Carbon::parse($today->check_out);
                    $hours = $start->diff($end)->format('%h hrs %i mins');
                @endphp

                <p><strong>Working Hours :</strong> {{ $hours }}</p>

            @endif

            @if(!$today->check_out)

                <form action="/punch-out" method="POST">
                    @csrf
                    <button type="submit" class="btn-delete">
                        Punch Out
                    </button>
                </form>

            @endif

        @endif

    </div>

</div>

@endsection