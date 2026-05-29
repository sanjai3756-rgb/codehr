<!DOCTYPE html>
<html>
<head>
    <title>Bulk KPI Reports</title>
</head>
<body>

<h2>Bulk KPI Reports</h2>

<table border="1" width="100%">

<tr>
    <th>Employee</th>
    <th>Month</th>
    <th>Year</th>
    <th>Score</th>
</tr>

@foreach($reports as $report)

<tr>

<td>
{{ $report->employee->name }}
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

</tr>

@endforeach

</table>

</body>
</html>