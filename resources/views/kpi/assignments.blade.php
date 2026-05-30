@extends('layouts.app')

@section('content')

<!-- TOP BAR -->
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>

<div class="kpimain">

    <div class="table-card">

        <div class="table-header">

            <div>

                <h2>KPI Assignments</h2>

                <p>
                    Manage KPI evaluator permissions
                </p>

            </div>

        </div>



        <!-- FORM -->

        <form
            action="{{ route('kpi.assignments.store') }}"
            method="POST"
        >

            @csrf


            <div class="settings-grid">


                <!-- TL -->

<div class="form-group">

    <label>
        Evaluator
    </label>

    <select
        name="evaluator_id"
        class="form-select"
    >

        @foreach($evaluators as $tl)

        <option value="{{ $tl->id }}">

            {{ $tl->name }}

            -

            {{ $tl->designation->designation_name ?? 'Staff' }}

        </option>

        @endforeach

    </select>

</div>                <!-- EMPLOYEE -->

<div class="form-group">

    <label class="input-label">
        Employees
    </label>



    <!-- SEARCH -->

    <input
        type="text"
        id="employeeSearch"
        placeholder="Search Employee..."
        class="employee-search-input"
        autocomplete="off"
    >



    <!-- DROPDOWN -->

    <div
        class="employee-dropdown"
        id="employeeDropdown"
    >

        @foreach($employees as $employee)

        <label class="employee-card">

            <div class="employee-left">

                <input
                    type="checkbox"
                    name="employee_id[]"
                    value="{{ $employee->id }}"
                    class="employee-checkbox"
                >



                <div>

                    <h4>

                        {{ $employee->name }}

                    </h4>

                    <p>

                        {{ $employee->designation->designation_name ?? '' }}

                    </p>

                </div>

            </div>

        </label>

        @endforeach

    </div>

</div>
    <!-- MONTH -->

                <div class="form-group">

                    <label>
                        Month
                    </label>

                    <select name="month">

                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>

                    </select>

                </div>



                <!-- YEAR -->

                <div class="form-group">

                    <label>
                        Year
                    </label>

                    <input
                        type="text"
                        name="year"
                        value="{{ date('Y') }}"
                    >

                </div>

            </div>



            <br>

            <button class="save-btn">

                Assign KPI

            </button>

        </form>



        <br><br>



        <!-- TABLE -->

        <table>

            <thead>

                <tr>

                    <th>TL</th>

                    <th>Employee</th>

                    <th>Month</th>

                    <th>Year</th>

                </tr>

            </thead>



            <tbody>

                @foreach($assignments as $assign)

                <tr>

                    <td>

                        {{ $assign->evaluator->name ?? '' }}

                    </td>

                    <td>

                        {{ $assign->employee->name ?? '' }}

                    </td>

                    <td>

                        {{ $assign->month }}

                    </td>

                    <td>

                        {{ $assign->year }}

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection