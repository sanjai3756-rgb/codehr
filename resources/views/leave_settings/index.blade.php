@extends('layouts.app')

@section('content')

<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        Back

    </a>

</div>



<div class="settings-card">

    <div class="settings-header">

        <h2>Leave Approval Settings</h2>

        <p>
            Configure leave approval workflow
        </p>

    </div>



@if(session('success'))

    <div class="toast-success"
         id="toast">

        {{ session('success') }}

    </div>

@endif


    <form method="POST"
          action="/leave-settings">

        @csrf



        <!-- AUTO APPROVE -->
        <div class="setting-item">

            <div>

                <h3>Auto Approve Leave</h3>

                <p>
                    Automatically approve all leave requests
                </p>

            </div>

            <input type="checkbox"
                   name="auto_approve"

                   {{ $setting->auto_approve ? 'checked' : '' }}>

        </div>



        <!-- HR -->
        <div class="setting-item">

            <div>

                <h3>HR Approval Access</h3>

                <p>
                    HR can approve leave requests
                </p>

            </div>

            <input type="checkbox"
                   name="hr_can_approve"

                   {{ $setting->hr_can_approve ? 'checked' : '' }}>

        </div>



        <!-- MANAGER -->
        <div class="setting-item">

            <div>

                <h3>Manager Approval Access</h3>

                <p>
                    Managers can approve leave requests
                </p>

            </div>

            <input type="checkbox"
                   name="manager_can_approve"

                   {{ $setting->manager_can_approve ? 'checked' : '' }}>

        </div>



        <button type="submit"
                class="save-btn">

            Save Settings

        </button>

    </form>

</div>

@endsection