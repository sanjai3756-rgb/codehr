<form method="POST" action="{{ route('leaves.store') }}">
@csrf

<select name="employee_id">
@foreach($employees as $emp)
<option value="{{ $emp->id }}">{{ $emp->name }}</option>
@endforeach
</select>

<select name="leave_type">
<option>Casual Leave</option>
<option>Sick Leave</option>
<option>Annual Leave</option>
</select>

<input type="date" name="from_date">
<input type="date" name="to_date">

<textarea name="reason" placeholder="Reason"></textarea>

<button type="submit">Apply Leave</button>

</form>