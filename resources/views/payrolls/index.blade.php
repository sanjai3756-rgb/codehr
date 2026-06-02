@extends('layouts.app')

@section('content')


<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>



<div class="table-card">


    <div class="table-header">


        <div>

            <h2>
                Payroll Management
            </h2>

            <p>
                Employee salary calculation with PF & ESI
            </p>

        </div>


        <a href="{{ route('payroll.settings') }}"
           class="save-btn">

            PF / ESI Settings

        </a>


    </div>




    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif




    <table>


        <thead>


            <tr>

                <th>S.No</th>

                <th>Employee</th>

                <th>Gross Salary</th>

                <th>PF</th>

                <th>ESI</th>

                <th>Total Deduction</th>

                <th>Net Salary</th>

            </tr>


        </thead>




        <tbody>


            @forelse($payrolls as $payroll)


            <tr>


                <td>

                    {{ $loop->iteration }}

                </td>



                <td>

                    {{ $payroll->employee->name ?? '-' }}

                </td>




                <td>

                    ₹ {{ number_format($payroll->gross_salary,2) }}

                </td>




                <td>

                    ₹ {{ number_format($payroll->pf_amount,2) }}

                </td>





                <td>

                    ₹ {{ number_format($payroll->esi_amount,2) }}

                </td>





                <td>

                    ₹ {{ number_format($payroll->total_deduction,2) }}

                </td>





                <td>

                    <b>

                    ₹ {{ number_format($payroll->net_salary,2) }}

                    </b>

                </td>



            </tr>



            @empty


            <tr>


                <td colspan="7">

                    No Payroll Generated

                </td>


            </tr>


            @endforelse



        </tbody>


    </table>


</div>


@endsection