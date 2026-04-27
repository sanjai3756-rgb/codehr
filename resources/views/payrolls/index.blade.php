@extends('layouts.app')

@section('content')

<div class="table-box">
<h2>Payroll</h2>

<table>
<tr>
<th>Employee</th>
<th>Month</th>
<th>Net Salary</th>
</tr>

@foreach($payrolls as $row)
<tr>
<td>{{ $row->employee->name ?? '-' }}</td>
<td>{{ $row->month }}</td>
<td>{{ $row->net_salary }}</td>
</tr>
@endforeach

</table>

</div>

@endsection