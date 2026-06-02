@extends('layouts.app')


@section('content')


<div class="form-card">


<h2>
Attendance Settings
</h2>


@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif



<form
method="POST"
action="{{ route('attendance.settings.update') }}"
>

@csrf


<div class="form-group">

<label>
Office Start Time
</label>

<input
type="time"
name="office_start_time"
value="{{ $setting->office_start_time }}"
>

</div>




<div class="form-group">

<label>
Full Day Hours
</label>

<input
type="number"
name="full_day_hours"
value="{{ $setting->full_day_hours }}"
>

</div>





<div class="form-group">

<label>
Half Day Hours
</label>

<input
type="number"
name="half_day_hours"
value="{{ $setting->half_day_hours }}"
>

</div>





<button class="save-btn">

Save Settings

</button>


</form>


</div>


@endsection