 
 
<div class="table-box">

<a href="/employee/dashboard" class="btn-back">← Back</a>


 {{-- Punch In --}}
@if(empty($today?->check_in))

<form method="POST" action="/punch-in" style="display:inline-block">
@csrf
<button class="btn-add">Punch In</button>
</form>

@else

<button class="btn-add" disabled style="opacity:.6;cursor:not-allowed;">
Already Punched In
</button>

@endif


{{-- Punch Out --}}
@if(!empty($today?->check_in) && empty($today?->check_out))

<form method="POST" action="/punch-out" style="display:inline-block">
@csrf
<button class="btn-edit">Punch Out</button>
</form>

@elseif(!empty($today?->check_out))

<button class="btn-edit" disabled style="opacity:.6;cursor:not-allowed;">
Already Punched Out
</button>


@endif