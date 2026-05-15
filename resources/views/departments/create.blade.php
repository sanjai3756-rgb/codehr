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



<!-- CARD -->
<div class="form-card">

    <!-- HEADER -->
    <div class="form-header">

        <div>

            <h2>Add Department</h2>

            <p>
                Create and manage department details
            </p>

        </div>

    </div>



    {{-- ERRORS --}}
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
          action="{{ route('departments.store') }}">

        @csrf



        {{-- <!-- DEPARTMENT CODE -->
        <div class="form-group">

            <label>

                Department Code

            </label>

            <input type="text"
                   name="department_code"
                   placeholder="Enter Department Code"
                   value="{{ old('department_code') }}">

        </div> --}}



        <!-- DEPARTMENT NAME -->
        <div class="form-group">

            <label>

                Department Name

            </label>

            <input type="text"
                   name="department_name"
                   placeholder="Enter Department Name"
                   value="{{ old('department_name') }}">

        </div>



        <!-- BUTTON -->
        <div class="form-footer">

            <button type="submit"
                    class="save-btn">

                Save Department

            </button>

        </div>

    </form>

</div>

@endsection