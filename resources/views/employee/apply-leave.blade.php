@extends('layouts.app')

@section('content')

<div class="table-box">

<h2>Apply Leave</h2>

<form method="POST" action="/apply-leave">
@csrf

<label>Leave Type</label>
<select name="leave_type">
<option value="Casual Leave">Casual Leave</option>
<option value="Sick Leave">Sick Leave</option>
<option value="Annual Leave">Annual Leave</option>
</select>

<label>From Date</label>
<input type="date" name="from_date">

<label>To Date</label>
<input type="date" name="to_date">

<label>Reason</label>
<textarea name="reason"></textarea>

<button type="submit" class="btn-add">Submit Leave</button>

</form>

</div>

@endsection