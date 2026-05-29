@extends('layouts.app')

@section('content')

<div class="kpimain">

```
<div class="table-card">

    <div class="table-header">

        <div>

            <h2>KPI Reports</h2>

            <p>Monthly KPI Reports & Downloads</p>

        </div>

    </div>

    <!-- FILTERS -->

<div class="report-top-bar">

    <form method="GET" class="report-filter-form">

        <input
            type="text"
            name="employee"
            placeholder="🔍 Search Employee..."
            value="{{ request('employee') }}"
            class="filter-search"
        >

        <select
            name="month"
            class="filter-select"
        >

            <option value="">
                All Months
            </option>

            @foreach([
                'January','February','March',
                'April','May','June',
                'July','August','September',
                'October','November','December'
            ] as $month)

            <option
                value="{{ $month }}"
                {{ request('month') == $month ? 'selected' : '' }}
            >

                {{ $month }}

            </option>

            @endforeach

        </select>

        <button
            type="submit"
            class="filter-btn"
        >
            Search
        </button>

        <button
            type="button"
            onclick="window.print()"
            class="print-btn"
        >
            Print
        </button>

    </form>

</div>
<br>

<form
    action="{{ route('kpi.bulk.pdf') }}"
    method="POST"
>

@csrf
    <table>

        <thead>

            <tr>

                <th>

                    <input
                        type="checkbox"
                        id="selectAll"
                    >

                </th>

                <th>Employee</th>

                <th>Evaluator</th>

                <th>Month</th>

                <th>Year</th>

                <th>Total Score</th>

                <th>Status</th>

                <th>Download</th>

            </tr>

        </thead>

        <tbody>

            @forelse($reports as $report)

            <tr>
            <td>
                 <input
                        type="checkbox"
                        name="report_ids[]"
                        value="{{ $report->id }}"
                        class="report-check"
                                             >
                      </td>

                <td>

                    {{ $report->employee->name ?? '-' }}

                </td>

                <td>

                    {{ $report->evaluator->name ?? '-' }}

                </td>

                <td>

                    {{ $report->month }}

                </td>

                <td>

                    {{ $report->year }}

                </td>

                <td>

                    {{ $report->total_score }}

                </td>

                <td>

                    @if($report->total_score >= 85)

                        <span class="status-success">
                            Excellent
                        </span>

                    @elseif($report->total_score >= 65)

                        <span class="status-warning">
                            Good
                        </span>

                    @else

                        <span class="status-danger">
                            Needs Improvement
                        </span>

                    @endif

                </td>

                <td>

           <a
               href="{{ route('kpi.pdf',$report->id) }}"
               class="edit-btn"
          >
             PDF
           </a>
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8">

                    No Reports Found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>
    <button
    type="submit"
    class="save-btn"
>
    Download Selected PDF
</button>

</form>

    <br>


</div>
```

</div>

<script>

document.getElementById(
    'selectAll'
).addEventListener(
    'change',
    function(){

        document.querySelectorAll(
            '.report-check'
        ).forEach(check => {

            check.checked =
                this.checked;

        });

    }
);

</script>
@endsection
