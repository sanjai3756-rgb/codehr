@extends('layouts.app')

@section('content')

<div class="top-bar">

<a href="{{ url()->previous() }}" class="back-btn">

    <i class="fa-solid fa-arrow-left"></i>

    Back

</a>
</div>

<div class="form-card">

    <div class="form-header">

        <div>

            <h2>Add Designation</h2>

            <p>
                Create new designation
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



    {{-- FORM --}}
    <form method="POST"
          action="{{ route('designations.store') }}">

        @csrf


        {{-- DEPARTMENT --}}
        <div class="form-group">

            <label>

                Department

            </label>

            <select name="department_id" required>

                <option value="">
                    Select Department
                </option>

                @foreach($departments as $department)

                    <option value="{{ $department->id }}">

                        {{ $department->department_name }}

                    </option>

                @endforeach

            </select>

        </div>



        {{-- DESIGNATION --}}
        <div class="form-group">

            <label>

                Designation Name

            </label>

            <input type="text"
                   name="designation_name"
                   placeholder="Enter Designation Name"
                   value="{{ old('designation_name') }}">

        </div>



        {{-- BUTTON --}}
        <div class="form-footer">

            <button type="submit"
                    class="save-btn">

                Save Designation

            </button>

        </div>

    </form>

</div>


@endsection