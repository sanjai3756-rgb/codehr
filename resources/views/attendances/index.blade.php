@extends('layouts.app')

@section('content')

<div class="table-box">
<h2>Attendance</h2>

<table>
<tr>
<th>Employee</th>
<th>Date</th>
<th>Status</th>
</tr>

@foreach($attendances as $row)
<tr>
<td>{{ $row->employee->name ?? '-' }}</td>
<td>{{ $row->date }}</td>
<td>{{ $row->status }}</td>
</tr>
@endforeach

</table>

</div>

@endsection