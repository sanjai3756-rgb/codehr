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

    <div class="table-card">

        <div class="kpitable-header">
            

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
                    class="kpifilter-select"
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
                    class="kpifilter-btn"
                >
                    Search
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

                <th width="50">
                    <input type="checkbox" id="selectAll">
                </th>

                <th>Employee</th>
                <th>Evaluator</th>
                <th>Month</th>
                <th>Year</th>
                <th>Total Score</th>
                <th>Status</th>
                <th>PDF</th>
                <th width="180">Actions</th>

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

                    @if($report->total_score >= 97)

                        <span class="status-success">
                            Employee of the Month
                        </span>

                    @elseif($report->total_score >= 85)

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
                        class="kpipdf-btn"
                    >
                        PDF
                    </a>

                </td>

                <td class="action-cell">

                    <a
                        href="{{ route('kpi.report.edit',$report->id) }}"
                        class="kpiedit-btn"
                    >
                        Edit
                    </a>

                    <button
                        type="button"
                        class="kpidelete-btn"
                        onclick="deleteReport({{ $report->id }})"
                    >
                        Delete
                    </button>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="9">

                    No Reports Found

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

    <br>

    <button
        type="submit"
        class="kpsave-btn"
    >
        Download Selected PDF
    </button>

</form>

@foreach($reports as $report)

<form
    id="delete-form-{{ $report->id }}"
    action="{{ route('kpi.report.delete',$report->id) }}"
    method="POST"
    style="display:none;"
>

    @csrf

    @method('DELETE')

</form>

@endforeach

        <br>

    </div>

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
<script>

function deleteReport(id)
{
    if(confirm('Delete this KPI Report?'))
    {
        document
            .getElementById(
                'delete-form-' + id
            )
            .submit();
    }
}

</script>

@endsection