@extends('layouts.app')


@section('content')


<div class="form-card">


    <div class="form-header">


        <div>


            <h2>

                Leave Settings

            </h2>



            <p>

                Manage employee leave and permission limits

            </p>


        </div>


    </div>





@if(session('success'))


<div class="alert alert-success">


    {{ session('success') }}


</div>


@endif








<form

method="POST"

action="{{ route('leave.settings.update') }}"

>


@csrf








<div class="form-grid">





<div class="form-group">


<label>

Monthly Paid Leave Limit (Days)

</label>



<input

type="number"

name="paid_leave_limit"

value="{{ $setting->paid_leave_limit }}"

required

>


<small>

Example : 1 paid leave every month

</small>


</div>










<div class="form-group">


<label>

Paid Permission Limit (Hours)

</label>




<input

type="number"

step="0.5"

name="paid_permission_hours"

value="{{ $setting->paid_permission_hours }}"

required

>



<small>

Example : 2 hours permission every month

</small>



</div>





</div>








<div class="form-footer">



<button

type="submit"

class="save-btn"

>


Save Settings


</button>




</div>






</form>



</div>



@endsection