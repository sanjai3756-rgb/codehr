@extends('layouts.app')

@section('content')

<div class="table-box">

<h2>My Attendance</h2>

<table>
<tr>
<th>Date</th>
<th>Status</th>
</tr>

@foreach($rows as $row)
<tr>
<td>{{ $row->date }}</td>
<td>{{ $row->status }}</td>
</tr>
@endforeach

</table>

</div>

@endsection