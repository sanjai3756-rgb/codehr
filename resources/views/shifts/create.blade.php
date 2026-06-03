@extends('layouts.app')

@section('content')

{{-- <!-- TOP BAR -- --}}
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>


<form method="POST"
action="{{ route('shifts.store') }}">

@csrf


<label>
Shift Name
</label>

<input 
name="name"
class="form-control">


<label>
Start Time
</label>

<input 
type="time"
name="start_time"
class="form-control">


<label>
End Time
</label>

<input 
type="time"
name="end_time"
class="form-control">


<label>
Allowed Late Minutes
</label>

<input 
type="number"
name="late_minutes"
class="form-control">


<button class="save-btn">

Save Shift

</button>


</form>

@endsection