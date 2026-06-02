@extends('layouts.app')


@section('content')


<div class="approval-page">


    <div class="approval-header">


        <div>

            <h2>
                Leave Approval Settings
            </h2>

            <p>
                Configure who can approve employee leaves
            </p>

        </div>


        <a
            href="javascript:history.back()"
            class="back-btn"
        >

            Back

        </a>


    </div>





@if(session('success'))

<div class="success-alert">

    {{ session('success') }}

</div>

@endif






<form
method="POST"
action="{{ route('leave.approval.update') }}"
>

@csrf




<div class="approval-grid">



<!-- AUTO APPROVE -->


<div class="approval-card">


    <div class="approval-icon">

        <i class="fa-solid fa-bolt"></i>

    </div>


    <div class="approval-info">


        <h3>
            Auto Approval
        </h3>


        <p>
            Automatically approve employee leave requests
        </p>


    </div>



    <label class="switch">


        <input
            type="checkbox"
            name="auto_approve"
            {{ $setting->auto_approve ? 'checked' : '' }}
        >


        <span class="slider"></span>


    </label>



</div>







<!-- HR -->


<div class="approval-card">


    <div class="approval-icon">

        <i class="fa-solid fa-user-tie"></i>

    </div>


    <div class="approval-info">


        <h3>
            HR Approval
        </h3>


        <p>
            Allow HR users to approve leaves
        </p>


    </div>



    <label class="switch">


        <input
            type="checkbox"
            name="hr_can_approve"
            {{ $setting->hr_can_approve ? 'checked' : '' }}
        >


        <span class="slider"></span>


    </label>



</div>








<!-- MANAGER -->


<div class="approval-card">


    <div class="approval-icon">

        <i class="fa-solid fa-users-gear"></i>

    </div>



    <div class="approval-info">


        <h3>
            Manager Approval
        </h3>


        <p>
            Allow managers to approve employee leaves
        </p>


    </div>



    <label class="switch">


        <input
            type="checkbox"
            name="manager_can_approve"
            {{ $setting->manager_can_approve ? 'checked' : '' }}
        >


        <span class="slider"></span>


    </label>



</div>





</div>







<div class="approval-footer">


<button
type="submit"
class="save-approval-btn"
>

Save Settings

</button>



</div>




</form>


</div>


@endsection