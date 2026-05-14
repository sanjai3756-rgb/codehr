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



<!-- EMPLOYEE CARD -->
<div class="employee-card">

    <!-- HEADER -->
    <div class="employee-header">

        <div>

            <h2>Add Employee</h2>

            <p>
                Create new employee profile
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
          action="{{ route('employees.store') }}"
          enctype="multipart/form-data">

        @csrf



        <div class="employee-grid">

            <!-- EMPLOYEE ID -->
            <div class="form-group">

                <label>

                    Employee ID

                </label>

                <input type="text"
                       name="employee_id"
                       placeholder="Enter Employee ID"
                       value="{{ old('employee_id') }}">

            </div>



            <!-- NAME -->
            <div class="form-group">

                <label>

                    Name

                </label>

                <input type="text"
                       name="name"
                       placeholder="Enter Employee Name"
                       value="{{ old('name') }}">

            </div>



            <!-- EMAIL -->
            <div class="form-group">

                <label>

                    Email

                </label>

                <input type="email"
                       name="email"
                       placeholder="Enter Email"
                       value="{{ old('email') }}">

            </div>



            <!-- PHONE -->
            <div class="form-group">

                <label>

                    Phone

                </label>

                <input type="text"
                       name="phone"
                       placeholder="Enter Phone Number"
                       value="{{ old('phone') }}">

            </div>



            <!-- DEPARTMENT -->
            <div class="form-group">

                <label>

                    Department

                </label>

                <select name="department_id">

                    <option value="">
                        Select Department
                    </option>

                    @foreach($departments as $dept)

                        <option value="{{ $dept->id }}">

                            {{ $dept->department_name }}

                        </option>

                    @endforeach

                </select>

            </div>



            <!-- DESIGNATION -->
            <div class="form-group">

                <label>

                    Designation

                </label>

                <select name="designation_id">

                    <option value="">
                        Select Designation
                    </option>

                    @foreach($designations as $des)

                        <option value="{{ $des->id }}">

                            {{ $des->designation_name }}

                        </option>

                    @endforeach

                </select>

            </div>



            <!-- JOIN DATE -->
            <div class="form-group">

                <label>

                    Joining Date

                </label>

                <input type="date"
                       name="joining_date">

            </div>



            <!-- SALARY -->
            <div class="form-group">

                <label>

                    Salary

                </label>

                <input type="text"
                       name="salary"
                       placeholder="Enter Salary">

            </div>



            <!-- PHOTO -->
            <div class="form-group full-width">

                <label>

                    Employee Photo

                </label>

                <input type="file"
                       name="photo"
                       class="file-input">

            </div>



            <!-- ADDRESS -->
            <div class="form-group full-width">

                <label>

                    Address

                </label>

                <textarea name="address"
                          rows="5"
                          placeholder="Enter Employee Address"></textarea>

            </div>

        </div>



        <!-- BUTTON -->
        <div class="employee-footer">

            <button type="submit"
                    class="save-btn">

                Save Employee

            </button>

        </div>

    </form>

</div>

@endsection