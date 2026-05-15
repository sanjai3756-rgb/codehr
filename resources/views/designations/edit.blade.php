@extends('layouts.app')

@section('content')
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>


<div class="form-card">

    <div class="form-header">

        <div>
            <h2>Edit Designation</h2>
            <p>Update designation details</p>
        </div>

    </div>


    <form method="POST"
          action="{{ route('designations.update',$designation->id) }}">

        @csrf
        @method('PUT')


        <div class="form-group">

            <label>Designation Name</label>

            <input type="text"
                   name="designation_name"
                   value="{{ $designation->designation_name }}">

        </div>


        <div class="form-footer">

            <button type="submit"
                    class="save-btn">

                Update Designation

            </button>

        </div>

    </form>

</div>

@endsection