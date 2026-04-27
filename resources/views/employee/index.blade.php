@extends('layouts.app')

@section('content')

<div class="table-box">

<div class="table-header">
    <h2>Employees</h2>
    <a href="{{ route('employees.create') }}" class="btn-add">+ Add Employee</a>
</div>

<table>

<thead>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Designation</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@foreach($employees as $row)

<tr>
<td>{{ $row->employee_id }}</td>
<td>{{ $row->name }}</td>
<td>{{ $row->email }}</td>
<td>{{ $row->department->department_name ?? '-' }}</td>
<td>{{ $row->designation->designation_name ?? '-' }}</td>

<td>
<span class="badge badge-success">Active</span>
</td>

<td>
<a href="#" class="btn-edit">Edit</a>
<button class="btn-delete">Delete</button>
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection