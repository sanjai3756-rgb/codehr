@extends('layouts.app')

@section('content')

<h2>Attendance Report</h2>

<form method="GET">

<select name="month">

<option value="">Select Month</option>

<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>

</select>
<select name="year">
<option value="">Year</option>
@for($y=2023;$y<=2030;$y++)
<option value="{{ $y }}">{{ $y }}</option>
@endfor
</select>

<button>Filter</button>

<a href="?export=pdf" class="btn-edit">PDF</a>
<a href="?export=excel" class="btn-delete">Excel</a>

</form>

<canvas id="chart" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chart'),{
type:'bar',
data:{
labels:['Present','Absent'],
datasets:[{
data:[{{ $present }},{{ $absent }}]
}]
}
});
</script>

@endsection