@extends('layouts.app')

@section('content')

<div class="profile-card">

<img src="https://i.pravatar.cc/120" class="profile-img">

<h2>{{ auth()->user()->name }}</h2>
<p>{{ auth()->user()->email }}</p>

<hr>

<p><strong>Role:</strong> {{ auth()->user()->role }}</p>
<p><strong>Phone:</strong> 9876543210</p>
<p><strong>Department:</strong> IT</p>

</div>

@endsection