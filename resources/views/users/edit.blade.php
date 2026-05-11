@extends('layouts.app')

@section('content')

<h2>Edit User</h2>

<form method="POST" action="{{ route('users.update',$user->id) }}">
@csrf
@method('PUT')

<input type="text" name="name" value="{{ $user->name }}">
<input type="email" name="email" value="{{ $user->email }}">

<select name="role">
    <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
    <option value="hr" {{ $user->role=='hr'?'selected':'' }}>HR</option>
    <option value="employee" {{ $user->role=='employee'?'selected':'' }}>Employee</option>
</select>

<button type="submit">Update</button>

</form>

@endsection