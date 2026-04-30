@extends('layouts.app')

@section('content')

<div class="table-box">
<div class="table-header">
<h2>Departments</h2>
<a href="{{ route('departments.create') }}" class="btn-add">+ Add Department</a>
</div>

<table class="table">

<thead>
<tr>
    <th>S.No</th>
    <th>Department Name</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

@foreach($departments as $key => $department)

<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $department->name }}</td>

    <td>

        <a href="{{ route('departments.edit',$department->id) }}" class="btn-edit">
            Edit
        </a>

        <form action="{{ route('departments.destroy',$department->id) }}"
              method="POST"
              style="display:inline-block;"
              onsubmit="return confirm('Delete Department?')">

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