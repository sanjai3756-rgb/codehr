<form method="POST" action="{{ route('attendances.store') }}">
@csrf

<select name="employee_id">
@foreach($employees as $emp)
<option value="{{ $emp->id }}">
{{ $emp->name }}
</option>
@endforeach
</select>

<input type="date" name="date">

<select name="status">
<option value="Present">Present</option>
<option value="Absent">Absent</option>
<option value="Leave">Leave</option>
</select>

<input type="time" name="check_in">
<input type="time" name="check_out">

<button type="submit">Save Attendance</button>

</form>