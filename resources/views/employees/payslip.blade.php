@extends('layouts.app')

@section('content')

<div class="table-box">

<h2>My Payslip</h2>

<table>
<tr>
<th>Month</th>
<th>Net Salary</th>
</tr>

@foreach($rows as $row)
<tr>
<td>{{ $row->month }}</td>
<td>₹{{ $row->net_salary }}</td>
</tr>
@endforeach

</table>

</div>

@endsection