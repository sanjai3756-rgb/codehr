@extends('layouts.app')

@section('content')


<div class="table-card">


<div class="table-header">

<div>

<h2>
Edit Staff Shift
</h2>

<p>
Change assigned shift
</p>

</div>

</div>



<form method="POST"
action="{{ route('users.shift.update',$user->id) }}">

@csrf

@method('PUT')



<label>
Staff Name
</label>


<input
class="form-control"
value="{{ $user->name }}"
readonly>




<br>



<label>
Select Shift
</label>


<select
name="shift_id"
class="form-control">


@foreach($shifts as $shift)


<option
value="{{ $shift->id }}"

@if($user->shift_id == $shift->id)

selected

@endif
>


{{ $shift->name }}

(
{{ date('h:i A',strtotime($shift->start_time)) }}

-

{{ date('h:i A',strtotime($shift->end_time)) }}
)


</option>


@endforeach


</select>




<br>



<button class="add-btn">

Update Shift

</button>


</form>


</div>


@endsection