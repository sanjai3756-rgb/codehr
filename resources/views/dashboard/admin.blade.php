@extends('layouts.app')

@section('content')

<h2 class="page-title">Admin Dashboard</h2>

<div class="dashboard-grid">

<div class="dash-card blue">
<h4>Total Employees</h4>
<h1>{{ $employees }}</h1>
</div>

<div class="dash-card green">
<h4>Departments</h4>
<h1>{{ $departments }}</h1>
</div>

<div class="dash-card orange">
<h4>Pending Leaves</h4>
<h1>{{ $leaves }}</h1>
</div>

<div class="dash-card purple">
<h4>Payrolls</h4>
<h1>{{ $payrolls }}</h1>
</div>

</div>
<div class="chart-box">
<h3>Monthly Employee Joining Report</h3>
<canvas id="employeeChart"></canvas>
</div>
<div class="chart-box">
<h3>Leave Status Report</h3>
<canvas id="leaveChart"></canvas>
</div>
@endsection

@section('scripts')

<script>
const ctx = document.getElementById('employeeChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun'],
        datasets: [{
            label: 'Employees Joined',
            data: [5,8,4,10,7,12],
            borderWidth: 1
        }]
    },
    options: {
        responsive:true,
        plugins:{
            legend:{
                display:true
            }
        },
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});
</script>

@endsection
@section('scripts')

<script>
const ctx = document.getElementById('employeeChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Jan','Feb','Mar','Apr','May','Jun',
            'Jul','Aug','Sep','Oct','Nov','Dec'
        ],
        datasets: [{
            label: 'Employees Joined',
            data: @json($chartData),
            borderWidth:1
        }]
    },
    options:{
        responsive:true,
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});
</script>
<script>
const leaveCtx = document.getElementById('leaveChart');

new Chart(leaveCtx, {
    type: 'pie',
    data: {
        labels: ['Pending','Approved','Rejected'],
        datasets: [{
            data: [
                {{ $pendingLeaves }},
                {{ $approvedLeaves }},
                {{ $rejectedLeaves }}
            ]
        }]
    },
    options:{
        responsive:true
    }
});
</script>

@endsection