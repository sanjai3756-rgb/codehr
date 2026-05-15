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

            <h2>Leave Requests</h2>

            <p>
                Employee leave management
            </p>

        </div>

    </div>


    <table>

        <thead>

            <tr>

                <th>Employee</th>

                <th>Leave Type</th>

                <th>From Date</th>

                <th>To Date</th>

                <th>Status</th>

            </tr>

        </thead>

    </table>

</div>

@endsection