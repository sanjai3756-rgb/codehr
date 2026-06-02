@extends('layouts.app')

@section('content')


<div class="form-card">


<h2>
Holiday Settings
</h2>



@if(session('success'))

<div class="success-alert">

{{ session('success') }}

</div>

@endif




<form
method="POST"
action="{{ route('holidays.store') }}"
>

@csrf


<div class="form-grid">


<div class="form-group">

<label>
Holiday Name
</label>

<input
type="text"
name="title"
placeholder="Ex: Pongal"
required
>

</div>




<div class="form-group">

<label>
Date
</label>

<input
type="date"
name="date"
required
>

</div>





<div class="form-group">

<label>
Holiday Type
</label>

<select name="type">

<option value="paid">
Paid Holiday
</option>

<option value="unpaid">
Unpaid Holiday
</option>

</select>

</div>


</div>



<button class="save-btn">

Add Holiday

</button>


</form>



</div>







<div class="table-card">


<h2>
Holiday List
</h2>


<table>


<thead>

<tr>

<th>Date</th>

<th>Name</th>

<th>Type</th>

<th>Action</th>

</tr>

</thead>



<tbody>


@foreach($holidays as $holiday)

<tr>


<td>

{{ $holiday->date }}

</td>



<td>

{{ $holiday->title }}

</td>



<td>


@if($holiday->type=='paid')


<span class="status-success">

Paid

</span>


@else


<span class="status-danger">

Unpaid

</span>


@endif


</td>



<td>


<form
method="POST"
action="{{ route('holidays.destroy',$holiday->id) }}"
>

@csrf

@method('DELETE')


<button class="delete-btn">

Delete

</button>


</form>


</td>



</tr>

@endforeach


</tbody>


</table>


</div>


@endsection