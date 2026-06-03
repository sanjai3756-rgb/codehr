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



<!-- FORM CARD -->
<div class="form-card">

    <!-- HEADER -->
    <div class="form-header">

        <div>

            <h2>Add Staffs</h2>

            <p>
                Create new employee user account
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
          action="{{ route('users.store') }}">

        @csrf



        <div class="form-grid">

            <!-- FULL NAME -->
            <div class="form-group">

                <label>

                    Full Name

                </label>

                <input type="text"
                       name="name"
                       placeholder="Enter Full Name"
                       value="{{ old('name') }}">

            </div>
          
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



            <!-- EMAIL -->
            <div class="form-group">

                <label>

                    Email Address

                </label>

                <input type="email"
                       name="email"
                       placeholder="Enter Email Address"
                       value="{{ old('email') }}">

            </div>



            <!-- PHONE -->
            <div class="form-group">

                <label>

                    Phone Number

                </label>

                <input type="text"
                       name="phone"
                       placeholder="Enter Phone Number"
                       value="{{ old('phone') }}">

            </div>



            <!-- PASSWORD -->
            <div class="form-group">

                <label>

                    Password

                </label>

                <input type="password"
                       name="password"
                       placeholder="Enter Password">

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

                    @foreach($departments as $department)

                        <option value="{{ $department->id }}">

                            {{ $department->department_name }}

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

                    @foreach($designations as $designation)

                        <option value="{{ $designation->id }}">

                            {{ $designation->designation_name }}

                        </option>

                    @endforeach

                </select>
                <select 
name="shift_id"
class="form-control">


@foreach($shifts as $shift)

<option value="{{ $shift->id }}">

{{$shift->name}}

{{$shift->start_time}}

-

{{$shift->end_time}}

</option>

@endforeach


</select>

            </div>

        </div>

        <div class="form-group">

    <label>
        Shift
    </label>

    <select 
        name="shift_id"
        class="form-control"
        required>

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
{{-- select role --}}
        <div class="form-group">

    <label>
        Role
    </label>

    <select name="role">

        <option value="">
            Select Role
        </option>

        <option value="admin">
            Admin
        </option>

        <option value="hr">
            HR
        </option>

        <option value="employee">
            Employee
        </option>

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
            <div class="form-group">

             <label>
                Salary Type
              </label>

                  <select
                    name="salary_type"
                    id="salaryType"
                    class="form-control"
                   >

                  <option value="hourly">
                    Hourly Rate
                    </option>

                     <option value="daily">
                         Daily Rate
                        </option>

                   </select>

            
           </div>

                <div
                  id="hourlyBox"
                  class="form-group"
                        >

                  <label>
                     Hourly Rate
                   </label>

                <input
                   type="number"
                   name="hourly_rate"
                   class="form-control"
                         >

            </div>

            <div
                 id="dailyBox"
                 class="form-group"
                 >

                <label>
                    Daily Rate
                 </label>

             <input
                 type="number"
                 name="daily_rate"
                 class="form-control"
                    >

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




        <!-- BUTTON -->
        <div class="form-footer">

            <button type="submit"
                    class="save-btn">

                Save Staff

            </button>

        </div>

    </form>

</div>
<div class="form-group full-width">

    <label>

        Permissions

    </label>

    <div class="permission-grid">

        @foreach($permissions as $permission)

            <label class="permission-item">

                <input type="checkbox"
                       name="permissions[]"
                       value="{{ $permission->name }}">

                <span>

                    {{ $permission->name }}

                </span>

            </label>

        @endforeach

    </div>

</div>

@endsection
<script>

function toggleSalary()
{
    let type =
        document.getElementById(
            'salaryType'
        ).value;

    document.getElementById(
        'hourlyBox'
    ).style.display =
        type === 'hourly'
        ? 'block'
        : 'none';

    document.getElementById(
        'dailyBox'
    ).style.display =
        type === 'daily'
        ? 'block'
        : 'none';
}

document
.getElementById('salaryType')
.addEventListener(
    'change',
    toggleSalary
);

toggleSalary();

</script>