@extends('layouts.app')

@section('content')

<div class="table-box">
<h2>Attendance</h2>

<table class="table">

<thead>
<tr>
    <th>S.No</th>
    <th>Employee</th>
    <th>Date</th>
    <th>Status</th>
    <th>Check In</th>
    <th>Check Out</th>
</tr>
</thead>

<tbody>

@foreach($attendances as $key => $attendance)

<tr>

<td>

@if($attendance->employee)

    {{ $attendance->employee->employee_id ?? $attendance->employee->id }}
    -
    {{ $attendance->employee->name }}

@else

    No Employee

@endif

</td>
</tr>

@endforeach

</tbody>

</table>
</div>

@endsection