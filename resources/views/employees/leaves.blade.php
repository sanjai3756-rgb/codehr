@extends('layouts.app')

@section('content')

<div class="table-box">

<h2>My Leaves</h2>

<table>
<tr>
<th>Type</th>
<th>From</th>
<th>To</th>
<th>Status</th>
</tr>

@foreach($rows as $row)
<tr>
<td>{{ $row->leave_type }}</td>
<td>{{ $row->from_date }}</td>
<td>{{ $row->to_date }}</td>
<td>{{ $row->status }}</td>
</tr>
@endforeach

</table>

</div>

@endsection