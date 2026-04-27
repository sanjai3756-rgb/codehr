<form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
@csrf

<input type="text" name="employee_id" placeholder="Employee ID">
<input type="text" name="name" placeholder="Name">
<input type="email" name="email" placeholder="Email">
<input type="text" name="phone" placeholder="Phone">

<select name="department_id">
@foreach($departments as $dept)
<option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
@endforeach
</select>

<select name="designation_id">
@foreach($designations as $des)
<option value="{{ $des->id }}">{{ $des->designation_name }}</option>
@endforeach
</select>

<input type="date" name="joining_date">
<input type="text" name="salary" placeholder="Salary">

<input type="file" name="photo">

<textarea name="address"></textarea>

<button type="submit">Save Employee</button>

</form>