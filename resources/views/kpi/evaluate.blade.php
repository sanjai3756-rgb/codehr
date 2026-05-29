@extends('layouts.app')

@section('content')

<div class="kpimain">

    <div class="table-card">


        <!-- HEADER -->

        <div class="table-header">

            <div>

                <h2>

                    KPI Evaluation

                </h2>

                <p>

                    {{ $employee->name }}

                    -
                    {{ $employee->designation->designation_name }}

                </p>

            </div>

        </div>



        <!-- FORM -->

        <form>


@foreach($questions as $question)

<div class="kpi-question-row">

    <!-- QUESTION -->

    <div class="question-title">

        <h4>{{ $question }}</h4>

    </div>



    <!-- WEEK 1 & 2 -->

    <div class="week-box">

        <label>Week 1 & 2</label>

        <input
            type="number"
            class="kpi-input week12"
            min="0"
            max="10"
            step="0.1"
        >

    </div>



    <!-- WEEK 3 & 4 -->

    <div class="week-box">

        <label>Week 3 & 4</label>

        <input
            type="number"
            class="kpi-input week34"
            min="0"
            max="10"
            step="0.1"
        >

    </div>



    <!-- FINAL -->

    <div class="week-box">

        <label>Final</label>

        <input
            type="text"
            class="kpi-input final-box"
            readonly
        >

    </div>

</div>

@endforeach



<!-- FINAL MONTH SCORE -->

<div class="final-score-box">

    <h2>

        Final Monthly KPI :

        <span id="finalScore">

            0

        </span>

        /100

    </h2>

</div>
{{-- <!-- FINAL TOTAL -->

            <div class="final-total-box">

                <h2>

                    Final Score :

                    <span id="finalScore">

                        0

                    </span>/100

                </h2>

            </div>
 --}}


            <!-- BUTTON -->

            <button class="save-btn">

                Submit KPI

            </button>

        </form>

    </div>

</div>



<!-- AUTO CALCULATION -->

<script>

document.addEventListener(

    'input',

    function(){

        let rows =
            document.querySelectorAll(
                '.kpi-question-row'
            );

        let total = 0;


        rows.forEach(row => {

            let inputs =
                row.querySelectorAll(
                    '.mark-input'
                );

            let avgBox =
                row.querySelector(
                    '.average-box'
                );


            let w1 =
                parseFloat(inputs[0].value) || 0;

            let w2 =
                parseFloat(inputs[1].value) || 0;


            let avg =
                (w1 + w2) / 2;


            avgBox.value =
                avg.toFixed(1);


            total += avg;

        });


        document.getElementById(
            'finalScore'
        ).innerText = total.toFixed(1);

    }

);

</script>

@endsection