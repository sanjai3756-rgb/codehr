@extends('layouts.app')

@section('content')

<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        Back

    </a>

</div>



<div class="table-card">

    <div class="table-header">

        <div>

            <h2>Leave Types</h2>

            <p>
                Manage leave types
            </p>

        </div>


        <a href="{{ route('leave-types.create') }}"
           class="add-btn">

            + Add Leave Type

        </a>

    </div>



    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Leave Name</th>

                <th>Days</th>

                <th>Action</th>

            </tr>

        </thead>



        <tbody>

            @foreach($leaveTypes as $leave)

                <tr>

                    <td>{{ $leave->id }}</td>

                    <td>{{ $leave->leave_name }}</td>

                    <td>{{ $leave->days }}</td>

<td>

    <!-- EDIT -->
    <a href="{{ route('leave-types.edit',$leave->id) }}"
       class="edit-btn">

        Edit

    </a>



    <!-- DELETE -->
    <form method="POST"
          action="{{ route('leave-types.destroy',$leave->id) }}"
          style="display:inline-block">

        @csrf
        @method('DELETE')

        <button type="submit"
                class="delete-btn"
                onclick="return confirm('Delete Leave Type?')">

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