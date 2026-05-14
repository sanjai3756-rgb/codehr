@extends('layouts.app')

@section('content')

<div class="table-card">

    <div class="table-header">

        <div>

            <h2>Departments</h2>

            <p>
                Manage company departments
            </p>

        </div>


        <a href="{{ route('departments.create') }}"
           class="add-btn">

            + Add Department

        </a>

    </div>



    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="toast-success" id="toast">

            {{ session('success') }}

        </div>

    @endif



    <table>

        <thead>

            <tr>

                <th>ID</th>

                <th>Department Name</th>

                <th>Created At</th>

                <th width="180">

                    Action

                </th>

            </tr>

        </thead>



        <tbody>

            @forelse($departments as $department)

                <tr>

                    <td>

                        {{ $department->id }}

                    </td>


                    <td>

                        {{ $department->department_name }}

                    </td>


                    <td>

                        {{ $department->created_at->format('d M Y') }}

                    </td>


                    <td>

                        <a href="{{ route('departments.edit',$department->id) }}"
                           class="edit-btn">

                            Edit

                        </a>


                        <form method="POST"
                              action="{{ route('departments.destroy',$department->id) }}"
                              style="display:inline-block">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Delete Department?')">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4"
                        class="empty-text">

                        No Departments Found

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection