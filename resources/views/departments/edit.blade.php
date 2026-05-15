@extends('layouts.app')

@section('content')

<!-- TOP BAR -->
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>



<!-- FORM CARD -->
<div class="form-card">

    <!-- HEADER -->
    <div class="form-header">

        <div>

            <h2>Edit Department</h2>

            <p>
                Update department information
            </p>

        </div>

    </div>



    <!-- ERRORS -->
    @if ($errors->any())

        <div class="error-box">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <!-- FORM -->
    <form method="POST"
          action="{{ route('departments.update',$department->id) }}">

        @csrf
        @method('PUT')



        <div class="form-grid">



            <!-- DEPARTMENT NAME -->
            <div class="form-group">

                <label>

                    Department Name

                </label>

                <input type="text"
                       name="department_name"
                       value="{{ $department->department_name }}"
                       placeholder="Enter Department Name">

            </div>

        </div>



        <!-- BUTTON -->
        <div class="form-footer">

            <button type="submit"
                    class="save-btn">

                Update Department

            </button>

        </div>

    </form>

</div>

@endsection