@extends('layouts.app')

@section('content')


<div class="payroll-setting-page">


    <div class="payroll-header">

        <div>

            <h2>
                Payroll Settings
            </h2>

            <p>
                Manage PF and ESI deduction rules
            </p>

        </div>


        <a
            href="{{ route('payrolls.index') }}"
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
    action="{{ route('payroll.settings.update') }}"
>

@csrf



<div class="settings-grid">



    <!-- PF -->


    <div class="setting-card">


        <div class="setting-title">


            <div>

                <h3>
                    Provident Fund (PF)
                </h3>

                <span>
                    Employee retirement contribution
                </span>

            </div>



            <label class="switch">

                <input
                    type="checkbox"
                    name="pf_enabled"
                    {{ $setting->pf_enabled ? 'checked' : '' }}
                >

                <span class="slider"></span>

            </label>


        </div>





        <div class="input-box">

            <label>
                PF Percentage
            </label>


            <div class="percentage-input">


                <input
                    type="number"
                    step="0.01"
                    name="pf_percentage"
                    value="{{ $setting->pf_percentage }}"
                >


                <span>%</span>


            </div>

        </div>




        <div class="info-box">

            Salary above ₹15,000 uses fixed PF calculation.

        </div>


    </div>









    <!-- ESI -->


    <div class="setting-card">


        <div class="setting-title">


            <div>

                <h3>
                    ESI Insurance
                </h3>

                <span>
                    Employee state insurance
                </span>

            </div>




            <label class="switch">

                <input
                    type="checkbox"
                    name="esi_enabled"
                    {{ $setting->esi_enabled ? 'checked' : '' }}
                >

                <span class="slider"></span>

            </label>



        </div>





        <div class="input-box">


            <label>

                ESI Percentage

            </label>



            <div class="percentage-input">


                <input
                    type="number"
                    step="0.01"
                    name="esi_percentage"
                    value="{{ $setting->esi_percentage }}"
                >


                <span>%</span>


            </div>


        </div>




        <div class="info-box">

            ESI applies only salary up to ₹21,000.

        </div>



    </div>




</div>






<div class="action-area">


    <button
        class="save-payroll-btn"
        type="submit"
    >

        Save Settings

    </button>


</div>




</form>


</div>


@endsection