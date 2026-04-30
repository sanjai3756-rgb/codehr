@extends('layouts.app')

@section('content')

<h2>Edit Employee</h2>

<form method="POST" action="{{ route('employees.update',$employee->id) }}" enctype="multipart/form-data">

@csrf
@method('PUT')

<input type="text" name="name" value="{{ $employee->name }}" placeholder="Name">

<input type="email" name="email" value="{{ $employee->email }}" placeholder="Email">

<button type="submit">Update</button>

</form>

@endsection