@extends('layouts.app')

@section('content')

<!-- TOP BAR -->
<div class="top-bar">



<!-- TABLE CARD -->
<div class="table-card">

    <!-- HEADER -->
    <div class="table-header">

        <div>

            <h2>Users</h2>

            <p>
                Manage system users and roles
            </p>

        </div>



      @if(auth()->user()->hasRole('Admin'))

<a href="{{ route('employees.create') }}"
class="add-btn">

+ Add Staffs

</a>

@endif

    </div>



    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="toast-success"
             id="toast">

            {{ session('success') }}

        </div>

    @endif



    <!-- TABLE -->
<table class="custom-table">

    <thead>

        <tr>

            <th>S.No</th>

            <th>Name</th>

            <th>Email</th>

            <th>Role</th>

            <th>Permissions</th>

            <th>Action</th>

        </tr>

    </thead>



    <tbody>

        @foreach($users as $user)

            <tr>

                <!-- SERIAL -->
                <td>

                    {{ $loop->iteration }}

                </td>



                <!-- NAME -->
                <td>

                    {{ $user->name }}

                </td>



                <!-- EMAIL -->
                <td>

                    {{ $user->email }}

                </td>
               

                <td>


               @if($user->shift)


              <span class="role-badge">

            {{ $user->shift->name }}

             <br>

             {{ date('h:i A',strtotime($user->shift->start_time)) }}

               -

            {{ date('h:i A',strtotime($user->shift->end_time)) }}
 

            </span>


            @else


              <span>
               No Shift
                </span>


             @endif


          </td>


                <!-- DESIGNATION -->
                <td>

                    <span class="role-badge">

                        {{ optional($user->designation)->designation_name ?? '-' }}

                    </span>

                </td>



                <!-- PERMISSIONS -->
@if(auth()->user()->hasRole('Admin'))

<td>

<a href="/permissions?user_id={{ $user->id }}"
class="permission-btn">

Manage Permissions

</a>

</td>


<td class="action-buttons">

<a href="{{ route('employees.edit',$user->id) }}"
class="edit-btn">

Edit

</a>


                    <form method="POST"
                          action="{{ route('users.destroy',$user->id) }}"
                          style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="delete-btn">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

    </tbody>

</table>
</div>

@endsection