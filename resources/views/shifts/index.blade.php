@extends('layouts.app')

@section('content')


<!-- TABLE CARD -->
<div class="table-card">


    <!-- HEADER -->
    <div class="table-header">


        <div>

            <h2>
                Shifts
            </h2>


            <p>
                Manage employee shifts and timings
            </p>

        </div>



        <div>


<a href="{{ route('employees.bulkShiftPage') }}"
   class="add-btn">

    Assign Shift

</a>

            <a href="{{ route('shifts.create') }}"
               class="add-btn">

                + Add Shift

            </a>


        </div>


    </div>





    {{-- SUCCESS MESSAGE --}}
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

                <th>
                    S.No
                </th>


                <th>
                    Shift Name
                </th>


                <th>
                    Start Time
                </th>


                <th>
                    End Time
                </th>


                <th>
                    Late Allowed
                </th>


                <th>
                    Status
                </th>


                <th>
                    Action
                </th>


            </tr>


        </thead>





        <tbody>


            @foreach($shifts as $shift)


            <tr>



                <td>

                    {{ $loop->iteration }}

                </td>





                <td>

                    <span class="role-badge">

                        {{ $shift->name }}

                    </span>

                </td>





                <td>

                    {{ date('h:i A', strtotime($shift->start_time)) }}

                </td>





                <td>

                    {{ date('h:i A', strtotime($shift->end_time)) }}

                </td>





                <td>

                    {{ $shift->late_minutes }}

                    Minutes

                </td>





                <td>


                    @if($shift->status)


                        <span class="role-badge">

                            Active

                        </span>


                    @else


                        -

                    @endif


                </td>






                <!-- ACTION -->

                <td class="action-buttons">



                    <a href="{{ route('shifts.edit',$shift->id) }}"
                       class="edit-btn">

                        Edit

                    </a>





                    <form method="POST"
                          action="{{ route('shifts.destroy',$shift->id) }}"
                          style="display:inline-block">


                        @csrf

                        @method('DELETE')



                        <button type="submit"
                                class="delete-btn"
                                onclick="return confirm('Delete Shift?')">

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