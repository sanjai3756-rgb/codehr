<!DOCTYPE html>

<html>

<head>

```
<title>KPI Report</title>

<style>

    body{
        font-family: Arial, sans-serif;
        font-size:14px;
        padding:20px;
    }

    .header{
        text-align:center;
        margin-bottom:20px;
    }

    .employee-info{
        margin-bottom:20px;
    }

    .employee-info p{
        margin:5px 0;
    }

    table{
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
    }

    table th,
    table td{
        border:1px solid #000;
        padding:8px;
        text-align:center;
    }

    table th{
        background:#f2f2f2;
    }

    .total-box{
        margin-top:20px;
        text-align:right;
    }

    .total-box h2{
        margin:0;
    }

    .footer{
        margin-top:30px;
    }

</style>
```

</head>

<body>

```
<div class="header">

    <h1>KPI REPORT</h1>

</div>

<div class="employee-info">

    <p>
        <strong>Employee :</strong>
        {{ $report->employee->name }}
    </p>

    <p>
        <strong>Evaluator :</strong>
        {{ $report->evaluator->name ?? '-' }}
    </p>

    <p>
        <strong>Month :</strong>
        {{ $report->month }}
    </p>

    <p>
        <strong>Year :</strong>
        {{ $report->year }}
    </p>

</div>

<table>

    <tr>

        <th>Question</th>

        <th>Week 1 & 2</th>

        <th>Week 3 & 4</th>

        <th>Final</th>

    </tr>

@foreach($report->scores as $score)

<tr>

<td>
{{ optional($score->question)->question ?? 'Question Missing' }}
</td>

<td>{{ $score->week1 }}</td>

<td>{{ $score->week2 }}</td>

<td>{{ $score->average }}</td>

</tr>

@endforeach

</table>

<div class="total-box">

    <h2>

        Final Monthly KPI :

        {{ number_format($report->total_score,2) }}

        /100

    </h2>

</div>

<div class="footer">

    <p>

        Generated On :
        {{ now()->format('d-m-Y h:i A') }}

    </p>

</div>
```

</body>

</html>
