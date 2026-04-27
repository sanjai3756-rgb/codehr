@extends('layouts.app')

@section('content')

<h2>Add User</h2>

<form method="POST" action="{{ route('users.store') }}">
@csrf

<input type="text" name="name" placeholder="Name">
<input type="email" name="email" placeholder="Email">

<select name="role">
<option value="admin">Admin</option>
<option value="hr">HR</option>
<option value="employee">Employee</option>
</select>

<input type="password" name="password" placeholder="Password">

<button type="submit">Save</button>

</form>

@endsection