@extends('layouts.app')

@section('content')

<div class="table-box">
<h2>Leaves</h2>

<table>
<tr>
<th>Employee</th>
<th>Type</th>
<th>Status</th>
</tr>

@foreach($leaves as $row)
<tr>
<td>{{ $row->employee->name ?? '-' }}</td>
<td>{{ $row->leave_type }}</td>
<td>{{ $row->status }}</td>
</tr>
@endforeach

</table>

</div>

@endsection