<form method="POST" action="{{ route('leaves.update',$leave->id) }}">
@csrf
@method('PUT')

<select name="status">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>
</select>

<button type="submit">Update</button>

</form>