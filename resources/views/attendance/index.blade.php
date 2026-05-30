@extends('layouts.app')

@section('content')

<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>


<div class="table-card">

    <div class="table-header">

        <div>

            <h2>Attendance</h2>

            <p>
                Employee attendance records
            </p>

        </div>

    </div>


    <table>

        <thead>

            <tr>

                <th>Employee</th>

                <th>Date</th>

                <th>Check In</th>

                <th>Check Out</th>

                <th>Status</th>

            </tr>

        </thead>

    </table>

</div>

@endsection