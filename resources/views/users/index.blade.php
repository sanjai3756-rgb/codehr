@extends('layouts.app')

@section('content')

<div class="table-box">

<div class="table-header">
<h2>Users</h2>
<a href="{{ route('users.create') }}" class="btn-add">+ Add User</a>
</div>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Role</th>
<th>Action</th>
</tr>

@foreach($users as $row)

<tr>
<td>{{ $row->id }}</td>
<td>{{ $row->name }}</td>
<td>{{ $row->email }}</td>
<td>{{ ucfirst($row->role) }}</td>
<td>

<a href="/permissions?user_id={{ $row->id }}">>
    Edit
</a>
<form action="{{ route('users.destroy',$row->id) }}" method="POST" style="display:inline">
@csrf
@method('DELETE')
<button class="btn-delete">Delete</button>
</form>

</td>
</tr>

@endforeach

</table>

</div>

@endsection