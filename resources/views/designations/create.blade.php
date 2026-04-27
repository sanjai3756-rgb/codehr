<form method="POST" action="{{ route('designations.store') }}">
@csrf

<select name="department_id">
<option value="">Select Department</option>

@foreach($departments as $dept)
<option value="{{ $dept->id }}">
{{ $dept->department_name }}
</option>
@endforeach

</select>

<input type="text" name="designation_name" placeholder="Designation Name">

<button type="submit">Save</button>

</form>