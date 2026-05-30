@extends('layouts.app')

@section('content')

<div class="kpimain">

```
<div class="table-card">

    <div class="table-header">

        <div>

            <h2>Edit KPI Report</h2>

            <p>

                {{ $report->employee->name ?? '' }}

            </p>

        </div>

    </div>

    <form
        action="{{ route('kpi.report.update',$report->id) }}"
        method="POST"
    >

        @csrf

        <input
            type="hidden"
            name="final_score"
            id="finalScoreInput"
            value="{{ $report->total_score }}"
        >

        @foreach($report->scores as $score)

        <input
            type="hidden"
            name="score_id[]"
            value="{{ $score->id }}"
        >

        <div class="kpi-question-row">

            <div class="question-title">

                <h4>

                    {{ $score->question->question ?? 'Question' }}

                </h4>

            </div>

            <div class="week-box">

                <label>
                    Week 1 & 2
                </label>

                <input
                    type="number"
                    name="week1[]"
                    value="{{ $score->week1 }}"
                    class="kpi-input week12"
                    min="0"
                    max="10"
                    step="0.1"
                >

            </div>

            <div class="week-box">

                <label>
                    Week 3 & 4
                </label>

                <input
                    type="number"
                    name="week2[]"
                    value="{{ $score->week2 }}"
                    class="kpi-input week34"
                    min="0"
                    max="10"
                    step="0.1"
                >

            </div>

            <div class="week-box">

                <label>
                    Final
                </label>

                <input
                    type="text"
                    name="average[]"
                    value="{{ $score->average }}"
                    class="kpi-input final-box"
                    readonly
                >

            </div>

        </div>

        @endforeach

        <div class="final-score-box">

            <h2>

                Final KPI :

                <span id="finalScore">

                    {{ number_format($report->total_score,2) }}

                </span>

                /100

            </h2>

        </div>

        <br>

        <button
            type="submit"
            class="save-btn"
        >

            Update KPI

        </button>

    </form>

</div>
```

</div>

<script>

function calculateKPI(){

    let grandTotal = 0;

    document.querySelectorAll(
        '.kpi-question-row'
    ).forEach(row => {

        let week1 =
            parseFloat(
                row.querySelector('.week12').value
            ) || 0;

        let week2 =
            parseFloat(
                row.querySelector('.week34').value
            ) || 0;

        let final =
            (week1 + week2) / 2;

        row.querySelector(
            '.final-box'
        ).value =
            final.toFixed(2);

        grandTotal += final;

    });

    let totalQuestions =
        document.querySelectorAll(
            '.kpi-question-row'
        ).length;

    let finalScore =
        (grandTotal / (totalQuestions * 10))
        * 100;

    document.getElementById(
        'finalScore'
    ).innerText =
        finalScore.toFixed(2);

    document.getElementById(
        'finalScoreInput'
    ).value =
        finalScore.toFixed(2);

}

document.querySelectorAll(
    '.week12,.week34'
).forEach(input => {

    input.addEventListener(
        'input',
        calculateKPI
    );

});

</script>

@endsection
