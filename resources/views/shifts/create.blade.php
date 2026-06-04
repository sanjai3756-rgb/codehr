@extends('layouts.app')

@section('content')


<div class="table-card">


    <div class="table-header">

        <div>

            <h2>
                Create Shift
            </h2>

            <p>
                Add new staff shift timing
            </p>

        </div>

    </div>





<form method="POST"
action="{{ route('shifts.store') }}">


@csrf



<!-- SHIFT NAME -->


<div class="shift-form-group">

<label>
Shift Name
</label>


<input
type="text"
name="name"
class="form-control"
placeholder="Morning Shift"
required>


</div>







<!-- START TIME -->

<div class="shift-form-group">

    <label>
        Start Time
    </label>


    <div class="shift-time-row">


        <select 
        name="start_hour"
        class="shift-select">

            @for($i=1;$i<=12;$i++)

            <option value="{{ $i }}">

                {{ str_pad($i,2,'0',STR_PAD_LEFT) }}

            </option>

            @endfor

        </select>



        <select 
        name="start_minute"
        class="shift-select">

            @for($i=0;$i<60;$i+=5)

            <option value="{{ $i }}">

                {{ str_pad($i,2,'0',STR_PAD_LEFT) }}

            </option>

            @endfor

        </select>



        <select 
        name="start_ampm"
        class="shift-select">

            <option>AM</option>

            <option>PM</option>

        </select>


    </div>


</div>






<!-- END TIME -->

<div class="shift-form-group">

    <label>
        End Time
    </label>


    <div class="shift-time-row">


        <select 
        name="end_hour"
        class="shift-select">

            @for($i=1;$i<=12;$i++)

            <option value="{{ $i }}">

                {{ str_pad($i,2,'0',STR_PAD_LEFT) }}

            </option>

            @endfor

        </select>




        <select 
        name="end_minute"
        class="shift-select">

            @for($i=0;$i<60;$i+=5)

            <option value="{{ $i }}">

                {{ str_pad($i,2,'0',STR_PAD_LEFT) }}

            </option>

            @endfor

        </select>




        <select 
        name="end_ampm"
        class="shift-select">

            <option>AM</option>

            <option selected>PM</option>

        </select>


    </div>


</div>




<!-- LATE -->


<div class="shift-form-group">


<label>
Late Allowed Minutes
</label>


<input
type="number"
name="late_minutes"
class="form-control"
placeholder="10"
required>


</div>






<button
class="add-btn">

Create Shift

</button>




</form>


</div>



@endsection