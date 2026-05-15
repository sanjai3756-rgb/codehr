@extends('layouts.app')

@section('content')

<div class="form-card">

    <h2>Edit Leave Type</h2>

    <form method="POST"
          action="{{ route('leave-types.update',$leaveType->id) }}">

        @csrf
        @method('PUT')


        <div class="form-group">

            <label>

                Leave Name

            </label>

            <input type="text"
                   name="leave_name"
                   value="{{ $leaveType->leave_name }}">

        </div>



        <div class="form-group">

            <label>

                Days

            </label>

            <input type="number"
                   name="days"
                   value="{{ $leaveType->days }}">

        </div>



        <button type="submit"
                class="save-btn">

            Update

        </button>

    </form>

</div>

@endsection