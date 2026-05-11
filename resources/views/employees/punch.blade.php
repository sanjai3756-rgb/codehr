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