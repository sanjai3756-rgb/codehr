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

            <h2>Payroll</h2>

            <p>
                Salary and payroll management
            </p>

        </div>

    </div>


    <table>

        <thead>

            <tr>

                <th>Employee</th>

                <th>Month</th>

                <th>Basic Salary</th>

                <th>Bonus</th>

                <th>Total Salary</th>

            </tr>

        </thead>

    </table>

</div>

@endsection