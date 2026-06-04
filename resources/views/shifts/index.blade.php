@extends('layouts.app')

@section('content')


<div class="table-card">


    <!-- HEADER -->

    <div class="table-header">


        <div>

            <h2>
                Shift Management
            </h2>

            <p>
                Manage shift timing and assigned staffs
            </p>

        </div>


        <div class="header-actions">


            <a href="{{ route('employees.bulkShiftPage') }}"
               class="add-btn">

                Assign Shift

            </a>


            <a href="{{ route('shifts.create') }}"
               class="add-btn">

                + Create Shift

            </a>


        </div>


    </div>






@if(session('success'))

<div class="toast-success">

{{ session('success') }}

</div>

@endif







<table class="custom-table">


<thead>

<tr>

<th>#</th>

<th>Shift</th>

<th>Timing</th>

<th>Assigned Staffs</th>

<th>Late</th>

<th>Status</th>

<th>Action</th>

</tr>

</thead>





<tbody>



@foreach($shifts as $shift)


<tr>



<td>

{{ $loop->iteration }}

</td>






<td>


<div class="shift-title">

{{ $shift->name }}

</div>


</td>






<td>


<div class="time-badge">


{{ date('h:i A',strtotime($shift->start_time)) }}

<br>

<span>

to

</span>

<br>


{{ date('h:i A',strtotime($shift->end_time)) }}


</div>


</td>







<td>


<div class="staff-count">

{{ $shift->users->count() }}

Staff Assigned

</div>





<div class="staff-list">


@forelse($shift->users as $user)


<div class="staff-chip">


<span>

{{ strtoupper(substr($user->name,0,1)) }}

</span>


{{ $user->name }}


<a href="{{ route('users.shift.edit',$user->id) }}">

✎

</a>


</div>



@empty


<p class="no-staff">

No Staff Assigned

</p>



@endforelse


</div>



</td>







<td>


{{ $shift->late_minutes }}

min


</td>






<td>


@if($shift->status)


<span class="active-badge">

Active

</span>


@else


-

@endif


</td>







<td class="action-buttons">


<a href="{{ route('shifts.edit',$shift->id) }}"
class="edit-btn">

Edit

</a>




<form method="POST"
action="{{ route('shifts.destroy',$shift->id) }}"
style="display:inline-block">


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