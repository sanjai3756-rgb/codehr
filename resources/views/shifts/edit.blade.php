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



<form
method="POST"
action="{{ route('shifts.update',$shift->id) }}">


@csrf

@method('PUT')


<label>
Name
</label>

<input
name="name"
value="{{$shift->name}}"
class="form-control">


<label>
Start Time
</label>

<input
type="time"
name="start_time"
value="{{$shift->start_time}}"
class="form-control">


<label>
End Time
</label>

<input
type="time"
name="end_time"
value="{{$shift->end_time}}"
class="form-control">


<label>
Late Minutes
</label>

<input
name="late_minutes"
value="{{$shift->late_minutes}}"
class="form-control">


<button class=" save-btn ">

Update

</button>


</form>


@endsection