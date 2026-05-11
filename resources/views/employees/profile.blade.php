@extends('layouts.app')

@section('content')

<div class="profile-page">

@if(session('success'))
<div class="success-msg">
    {{ session('success') }}
</div>
@endif

<div class="profile-card">

<div class="profile-top">

@if($employee && $employee->photo)
<img src="{{ asset('uploads/profile/'.$employee->photo) }}" class="profile-img">
@else
<img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" class="profile-img">
@endif

<h2>{{ auth()->user()->name }}</h2>
<p>{{ auth()->user()->email }}</p>

</div>

<form method="POST" action="/profile/update" enctype="multipart/form-data">
@csrf

<div class="grid-2">

<div>
<label>Name</label>
<input type="text" value="{{ auth()->user()->name }}" readonly>
</div>

<div>
<label>Email</label>
<input type="text" value="{{ auth()->user()->email }}" readonly>
</div>

<div>
<label>Department</label>
<input type="text" value="{{ $employee->department->name ?? '-' }}" readonly>
</div>

<div>
<label>Designation</label>
<input type="text" value="{{ $employee->designation->name ?? '-' }}" readonly>
</div>

<div>
<label>Phone Number</label>
<input type="text" name="phone" value="{{ $employee->phone ?? '' }}">
</div>

<div>
<label>Upload Photo</label>
<input type="file" name="photo">
</div>

</div>

<button class="save-btn">
Update Profile
</button>

</form>

</div>

</div>

@endsection