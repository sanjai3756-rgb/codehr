@extends('layouts.app')

@section('content')

<div class="container">

    <h3 class="mb-4">
        Add Employee
    </h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <form 
        method="POST" 
        action="{{ route('employees.store') }}"
        enctype="multipart/form-data">

        @csrf


        <!-- Name -->
        <div class="mb-3">

            <label>
                Name
            </label>

            <input 
                type="text"
                name="name"
                class="form-control"
                required>

        </div>



        <!-- Email -->
        <div class="mb-3">

            <label>
                Email
            </label>

            <input 
                type="email"
                name="email"
                class="form-control"
                required>

        </div>



        <!-- Phone -->
        <div class="mb-3">

            <label>
                Phone
            </label>

            <input 
                type="text"
                name="phone"
                class="form-control">

        </div>



        <!-- Department -->
        <div class="mb-3">

            <label>
                Department
            </label>

            <select 
                name="department_id"
                class="form-control">

                <option value="">
                    Select Department
                </option>

                @foreach($departments as $department)

                    <option value="{{ $department->id }}">

                        {{ $department->name }}

                    </option>

                @endforeach

            </select>

        </div>




        <!-- Designation -->
        <div class="mb-3">

            <label>
                Designation
            </label>

            <select 
                name="designation_id"
                class="form-control">

                <option value="">
                    Select Designation
                </option>

                @foreach($designations as $designation)

                    <option value="{{ $designation->id }}">

                        {{ $designation->name }}

                    </option>

                @endforeach

            </select>

        </div>




        <!-- Shift -->
        <div class="mb-3">

            <label>
                Shift
            </label>

            <select 
                name="shift_id"
                class="form-control">

                <option value="">
                    Select Shift
                </option>


                @foreach($shifts as $shift)

                    <option value="{{ $shift->id }}">

                        {{ $shift->name }}
                        (
                        {{ $shift->start_time }}
                        -
                        {{ $shift->end_time }}
                        )

                    </option>

                @endforeach

            </select>

        </div>




        <!-- Salary -->
        <div class="mb-3">

            <label>
                Salary
            </label>

            <input 
                type="number"
                name="salary"
                class="form-control">

        </div>




        <!-- Joining Date -->
        <div class="mb-3">

            <label>
                Joining Date
            </label>

            <input 
                type="date"
                name="joining_date"
                class="form-control">

        </div>




        <!-- Address -->
        <div class="mb-3">

            <label>
                Address
            </label>

            <textarea
                name="address"
                class="form-control">
            </textarea>

        </div>




        <!-- Photo -->
        <div class="mb-3">

            <label>
                Photo
            </label>

            <input 
                type="file"
                name="photo"
                class="form-control">

        </div>



        <button 
            class="btn btn-primary">

            Save Employee

        </button>


        <a 
            href="{{ route('employees.index') }}"
            class="btn btn-secondary">

            Back

        </a>


    </form>


</div>


@endsection