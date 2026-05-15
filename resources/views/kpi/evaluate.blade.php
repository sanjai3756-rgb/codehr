@extends('layouts.app')

@section('content')

<div class="main">

    <div class="settings-card">

        <div class="settings-header">
            <h2>
                KPI Evaluation
            </h2>

            <p>
                {{ $employee->name }}
                -
                {{ $employee->designation->designation_name }}
            </p>
        </div>


        <form action="{{ route('kpi.store') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="employee_id"
                   value="{{ $employee->id }}">


            @foreach($categories as $category)

            <div class="kpi-category-box">

                <h3>
@endsection