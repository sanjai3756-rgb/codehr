@extends('layouts.app')

@section('content')

<h2>Admin Settings Panel</h2>

@if(session('success'))
<div class="success-msg">{{ session('success') }}</div>
@endif

<div class="settings-card">

<form method="POST" action="/settings/update" enctype="multipart/form-data">
@csrf

<label>Company Name</label>
<input type="text" name="company_name" value="{{ $setting->company_name ?? '' }}">

<label>Company Email</label>
<input type="text" name="company_email" value="{{ $setting->company_email ?? '' }}">

<label>Phone</label>
<input type="text" name="phone" value="{{ $setting->phone ?? '' }}">

<label>Currency</label>
<input type="text" name="currency" value="{{ $setting->currency ?? 'INR' }}">

<label>Timezone</label>
<input type="text" name="timezone" value="{{ $setting->timezone ?? 'Asia/Kolkata' }}">

<label>Theme Color</label>
<input type="color" name="theme_color" value="{{ $setting->theme_color ?? '#2563eb' }}">

<label>Company Logo</label>
<input type="file" name="logo">

@if($setting && $setting->logo)
<img src="{{ asset('uploads/logo/'.$setting->logo) }}" width="100">
@endif

<br><br>

<button class="btn-edit">Save Settings</button>

</form>

</div>

@endsection