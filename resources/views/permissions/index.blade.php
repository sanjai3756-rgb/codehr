@extends('layouts.app')

@section('content')

<div class="permission-page">

    <!-- Header -->
    <div class="perm-header">
        <div>
            <h2>Permissions Management</h2>
            <p>Control module access for roles</p>
        </div>

        <a href="/users" class="btn-back">← Back</a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/permissions/assign">
        @csrf

        <!-- Role Select -->
        <div class="card-box">

            <div class="form-group">
                <label>Select Role</label>
                <select name="role_id" class="input-box">
                    <option value="">Choose Role</option>

                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach

                </select>
            </div>

        </div>

        <!-- Permissions -->
        <div class="card-box mt-20">

            <h4 class="section-title">Permissions</h4>

            <div class="permission-grid">

                @foreach($permissions as $permission)

                <label class="permission-item">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                    <span>{{ ucfirst($permission->name) }}</span>
                </label>

                @endforeach

            </div>

        </div>

        <!-- Save Button -->
        <div class="action-bar">
            <button type="submit" class="save-btn">
                Save Changes
            </button>
        </div>

    </form>

</div>

@endsection