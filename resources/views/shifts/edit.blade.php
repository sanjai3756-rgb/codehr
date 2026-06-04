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



<form
method="POST"
action="{{ route('shifts.update',$shift->id) }}">


@csrf

@method('PUT')


<label>
Name
</label>

<input
name="name"
value="{{$shift->name}}"
class="form-control">


<div class="shift-form-group">

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


<label>
Late Minutes
</label>

<input
name="late_minutes"
value="{{$shift->late_minutes}}"
class="form-control">


<button class=" save-btn ">

Update

</button>



@endsection