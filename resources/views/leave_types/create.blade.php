@extends('layouts.app')

@section('content')

<div class="form-card">

    <h2>Add Leave Type</h2>

    <form method="POST"
          action="{{ route('leave-types.store') }}">

        @csrf


        <div class="form-group">

            <label>

                Leave Name

            </label>

            <input type="text"
                   name="leave_name">

        </div>



        <div class="form-group">

            <label>

                Days

            </label>

            <input type="number"
                   name="days">

        </div>



        <button type="submit"
                class="save-btn">

            Save

        </button>

    </form>

</div>

@endsection