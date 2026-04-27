@extends('layouts.app')

@section('content')

<div class="table-box">
<h2>Designations</h2>

<table>
<tr>
<th>ID</th>
<th>Department</th>
<th>Designation</th>
</tr>

@foreach($designations as $row)
<tr>
<td>{{ $row->id }}</td>
<td>{{ $row->department->department_name ?? '-' }}</td>
<td>{{ $row->designation_name }}</td>
</tr>
@endforeach

</table>

</div>

@endsection