<form method="POST" action="{{ route('departments.update',$department->id) }}">
@csrf
@method('PUT')

<input type="text" name="department_name"
value="{{ $department->department_name }}">

<input type="text" name="department_code"
value="{{ $department->department_code }}">

<button type="submit">Update</button>

</form>