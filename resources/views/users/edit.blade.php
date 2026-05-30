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

            <h2>Edit User</h2>

            <p>
                Update user details, department and designation
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
          action="{{ route('users.update',$user->id) }}">

        @csrf
        @method('PUT')



        <div class="form-grid">

            <!-- NAME -->
            <div class="form-group">

                <label>

                    Full Name

                </label>

                <input type="text"
                       name="name"
                       value="{{ $user->name }}">

            </div>


            <!-- EMPLOYEE ID -->
        <div class="form-group">

        <label>

        Employee ID

        </label>

          <input type="text"
           name="employee_id"
           value="{{ $user->employee_id }}">

       </div>



            <!-- EMAIL -->
            <div class="form-group">

                <label>

                    Email Address

                </label>

                <input type="email"
                       name="email"
                       value="{{ $user->email }}">

            </div>



            <!-- PASSWORD -->
            <div class="form-group">

                <label>

                    Password

                </label>

                <input type="password"
                       name="password"
                       placeholder="Leave blank to keep old password">

            </div>



            <!-- DEPARTMENT -->
            <div class="form-group">

                <label>

                    Department

                </label>

                <select name="department_id">

                    @foreach($departments as $department)

                        <option value="{{ $department->id }}"

                            {{ optional(optional($user->designation)->department)->id == $department->id ? 'selected' : '' }}>

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

                    @foreach($designations as $designation)

                        <option value="{{ $designation->id }}"

                            {{ $user->designation_id == $designation->id ? 'selected' : '' }}>

                            {{ $designation->designation_name }}

                        </option>

                    @endforeach

                </select>

            </div>

        </div>

        {{-- select role --}}

        <div class="form-group">

    <label>
        Role
    </label>

    <select name="role">

        <option
            value="admin"
            {{ $user->hasRole('admin') ? 'selected' : '' }}
        >
            Admin
        </option>

        <option
            value="hr"
            {{ $user->hasRole('hr') ? 'selected' : '' }}
        >
            HR
        </option>

        <option
            value="employee"
            {{ $user->hasRole('employee') ? 'selected' : '' }}
        >
            Employee
        </option>

    </select>

</div>
        <!-- SALARY -->
      <div class="form-group">

               <label>

             Salary

            </label>

         <input type="text"
           name="salary"
           value="{{ $user->salary }}">

             </div>


             <div class="form-group">

    <label>
        Salary Type
    </label>

    <select
        name="salary_type"
        id="salaryType"
    >

        <option
            value="hourly"
            {{ $user->salary_type == 'hourly' ? 'selected' : '' }}
        >
            Hourly Rate
        </option>

        <option
            value="daily"
            {{ $user->salary_type == 'daily' ? 'selected' : '' }}
        >
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
        value="{{ $user->hourly_rate }}"
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
        value="{{ $user->daily_rate }}"
    >

</div>
          <!-- JOINING DATE -->
<div class="form-group">

    <label>

        Joining Date

    </label>

    <input type="date"
           name="joining_date"
           value="{{ $user->joining_date }}">

</div>



<!-- PHOTO -->
      <div class="form-group full-width">

    <label>

        Profile Photo

    </label>

    <input type="file"
           name="photo">

         </div>   





        <!-- BUTTON -->
        <div class="form-footer">

            <button type="submit"
                    class="save-btn">

                Update User

            </button>

        </div>

    </form>

</div>

@endsection