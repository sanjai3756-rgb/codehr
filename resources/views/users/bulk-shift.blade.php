@extends('layouts.app')

@section('content')


{{-- <!-- TOP BAR -- --}}
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>



<div class="table-card">


    <!-- HEADER -->

    <div class="table-header">


        <div>

            <h2>
                Assign Shift
            </h2>

            <p>
                Bulk assign shift timings to staffs
            </p>

        </div>


    </div>




@if(session('success'))

<div class="toast-success">

{{ session('success') }}

</div>

@endif





<form method="POST"
action="{{ route('employees.bulkShift') }}">


@csrf




<!-- SHIFT SELECT -->


<div style="margin-bottom:20px">


<label>

Select Shift

</label>


<select 
name="shift_id"
class="form-control"
required>


<option value="">

Choose Shift

</option>



@foreach($shifts as $shift)


<option value="{{ $shift->id }}">


{{ $shift->name }}

(

{{ date('h:i A',strtotime($shift->start_time)) }}

-

{{ date('h:i A',strtotime($shift->end_time)) }}

)


</option>


@endforeach


</select>


</div>






<!-- SEARCH -->


<div style="margin-bottom:15px">


<input
type="text"
id="employeeSearch"
class="form-control"
placeholder="🔍 Search staff name or email...">


</div>








<table class="custom-table"
id="employeeTable">



<thead>


<tr>


<th>

<input
type="checkbox"
id="selectAll">

</th>



<th>

S.No

</th>



<th>

Staff Name

</th>



<th>

Email

</th>



<th>

Current Shift

</th>



</tr>


</thead>





<tbody>



@foreach($users as $user)



<tr>


<td>


<input
type="checkbox"
class="userCheck"
name="users[]"
value="{{ $user->id }}">


</td>





<td>

{{ $loop->iteration }}

</td>





<td>


<strong>

{{ $user->name }}

</strong>


</td>






<td>


{{ $user->email }}


</td>







<td>


@if($user->shift)


<span class="role-badge">

{{ $user->shift->name }}

</span>


@else


<span>

No Shift

</span>


@endif


</td>





</tr>




@endforeach




</tbody>




</table>






<br>




<button
class="add-btn">


Assign Selected Shift


</button>





</form>


</div>








<script>


// SELECT ALL


document
.getElementById('selectAll')
.addEventListener(
'click',
function()
{


let checks =
document.querySelectorAll('.userCheck');


checks.forEach(

item => item.checked = this.checked

);


});






// SEARCH


document
.getElementById('employeeSearch')
.addEventListener(
'keyup',
function()
{


let value =
this.value.toLowerCase();


let rows =
document.querySelectorAll(
'#employeeTable tbody tr'
);



rows.forEach(function(row)
{


let text =
row.innerText.toLowerCase();



row.style.display =
text.includes(value)

?

''

:

'none';



});


});


</script>




@endsection