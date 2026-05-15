@extends('layouts.app')

@section('content')
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>


<div class="permission-wrapper">

    <div class="permission-card">

        {{-- HEADER --}}
        <div class="permission-header">

            <div>
                <h2>
                    Role & Permissions
                </h2>

                <p>
                    Manage user access and module permissions
                </p>
            </div>

        </div>


        {{-- SUCCESS --}}
@if(session('success'))

<div class="toast-success" id="toast">

    {{ session('success') }}

</div>

@endif

        {{-- USER INFO --}}
        <div class="user-info">

            <div class="user-avatar">

                {{ strtoupper(substr($user->name,0,1)) }}

            </div>

            <div>

                <h3>{{ $user->name }}</h3>

                <span>{{ $user->email }}</span>

            </div>

        </div>


        {{-- FORM --}}
<form method="POST"
      action="{{ url('/permissions/update') }}">
            @csrf

            <input type="hidden"
                   name="user_id"
                   value="{{ $user->id }}">


            {{-- PERMISSIONS --}}
            <div class="permission-grid">

                @foreach($permissions as $permission)

                    <label class="permission-item">

                        <input type="checkbox"
                               name="permissions[]"
                               value="{{ $permission->name }}"
                             {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>

                        <span>

                            {{ ucwords(str_replace('-',' ',$permission->name)) }}

                        </span>

                    </label>

                @endforeach

            </div>


            {{-- BUTTON --}}
            <div class="permission-footer">

                <button type="submit"
                        class="save-btn">

                    Save Permissions

                </button>

            </div>

        </form>

    </div>

</div>

@endsection