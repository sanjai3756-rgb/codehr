@extends('layouts.app')

@section('content')

<!-- TOP BAR -->
<div class="top-bar">

    <a href="javascript:history.back()"
       class="back-btn">

        <i class="fa-solid fa-arrow-left"></i>

        Back

    </a>

</div>


<div class="kpimain">

```
<div class="table-card">

    <div class="table-header">

        <div>

            <h2>KPI Evaluation</h2>

            <p>
                {{ $employee->name }}
                -
                {{ $employee->designation->designation_name ?? '' }}
            </p>

        </div>

    </div>

    <form action="{{ route('kpi.submit') }}" method="POST">

        @csrf

        <input
            type="hidden"
            name="employee_id"
            value="{{ $employee->id }}"
        >

        <input
            type="hidden"
            name="final_score"
            id="finalScoreInput"
            value="0"
        >

@foreach($template->categories as $category)

<div class="kpi-category-box">

    <h3>{{ $category->category }}</h3>

    @foreach($category->questions as $question)

    <input
        type="hidden"
        name="question_id[]"
        value="{{ $question->id }}"
    >

    <div class="kpi-question-row">

        <div class="question-title">

            <h4>{{ $question->question }}</h4>

        </div>

        <div class="week-box">

            <label>Week 1 & 2</label>

            <input
                type="number"
                name="week1[]"
                class="kpi-input week12"
                min="0"
                max="10"
                step="0.1"
            >

        </div>

        <div class="week-box">

            <label>Week 3 & 4</label>

            <input
                type="number"
                name="week2[]"
                class="kpi-input week34"
                min="0"
                max="10"
                step="0.1"
            >

        </div>

        <div class="week-box">

            <label>Final</label>

            <input
                type="text"
                name="average[]"
                class="kpi-input final-box"
                readonly
            >

        </div>

    </div>

    @endforeach

</div>

@endforeach

        <div class="final-score-box">

            <h2>

                Final Monthly KPI :

                <span id="finalScore">0</span>

                /100

            </h2>

        </div>

        <br>

        <button
            type="submit"
            class="save-btn"
        >
            Submit KPI
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
</script>

@endsection
