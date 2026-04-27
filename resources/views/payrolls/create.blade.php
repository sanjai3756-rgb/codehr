<form method="POST" action="{{ route('payrolls.store') }}">
@csrf

<select name="employee_id">
@foreach($employees as $emp)
<option value="{{ $emp->id }}">{{ $emp->name }}</option>
@endforeach
</select>

<input type="text" name="month" placeholder="April 2026">

<input type="text" name="basic_salary" placeholder="Basic Salary">
<input type="text" name="allowance" placeholder="Allowance">
<input type="text" name="bonus" placeholder="Bonus">
<input type="text" name="deduction" placeholder="Deduction">

<button type="submit">Generate Payroll</button>

</form>