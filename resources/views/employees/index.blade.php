@extends('layouts.app')

@section('content')

<div class="table-box">

<div class="table-header">
<h2>Employees</h2>

<a href="{{ route('employees.create') }}" class="btn-add">
+ Add Employee
</a>

</div>

<table class="table">

<thead>
<tr>
    <th>S.No</th>
    <th>Name</th>
    <th>Email</th>
    <th>Department</th>
    <th>Designation</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($employees as $key => $employee)

<tr>

    <td>{{ $key + 1 }}</td>
    <td>{{ $employee->name }}</td>
    <td>{{ $employee->email }}</td>

    <td>{{ $employee->department->name ?? '-' }}</td>

    <td>{{ $employee->designation->name ?? '-' }}</td>

    <td>

        <a href="{{ route('employees.edit',$employee->id) }}" class="btn-edit">
            Edit
        </a>

        <form action="{{ route('employees.destroy',$employee->id) }}"
              method="POST"
              style="display:inline-block;"
              onsubmit="return confirm('Delete Employee?')">

            @csrf
            @method('DELETE')

            <button class="btn-delete">
                Delete
            </button>

        </form>

    </td>

</tr>

@endforeach

</tbody>
</table>
</div>

@endsection