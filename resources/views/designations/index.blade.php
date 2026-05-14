@extends('layouts.app')

@section('content')

<div class="table-card">

    <div class="table-header">

        <div>

            <h2>Designations</h2>

            <p>
                Manage company designations
            </p>

        </div>


        <a href="{{ route('designations.create') }}"
           class="add-btn">

            + Add Designation

        </a>

    </div>


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

             <th>Designation Name</th>


                <th>Created At</th>

                <th width="180">
                    Action
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($designations as $designation)

                <tr>

                    <td>
                        {{ $designation->id }}
                    </td>
                     <td>

                     {{ $designation->department->department_name ?? '-' }}

                    </td>

                    <td>
                        {{ $designation->designation_name }}
                    </td>

                    <td>
                        {{ $designation->created_at->format('d M Y') }}
                    </td>

                    <td>

                        <a href="{{ route('designations.edit',$designation->id) }}"
                           class="edit-btn">

                            Edit

                        </a>


                        <form method="POST"
                              action="{{ route('designations.destroy',$designation->id) }}"
                              style="display:inline-block">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="delete-btn"
                                    onclick="return confirm('Delete Designation?')">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4"
                        style="text-align:center">

                        No Designations Found

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection