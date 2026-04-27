<form method="POST" action="{{ route('departments.store') }}">
    @csrf

    <label>Name</label>
    <input type="text" name="department_name">

    <label>Code</label>
    <input type="text" name="department_code">

    <button type="submit">Save</button>
</form>