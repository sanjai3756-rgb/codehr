@extends('layouts.app')

@section('content')

<div class="table-box">
<div class="table-header">
<h2>Departments</h2>
<a href="{{ route('departments.create') }}" class="btn-add">+ Add Department</a>
</div>

<table>
<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Code</th>
</tr>
</thead>

<tbody>
@foreach($departments as $row)
<tr>
<td>{{ $row->id }}</td>
<td>{{ $row->department_name }}</td>
<td>{{ $row->department_code }}</td>
</tr>
@endforeach
</tbody>
</table>

</div>

@endsection