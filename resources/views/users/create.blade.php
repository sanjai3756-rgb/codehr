<h4>Permissions</h4>

@foreach($permissions as $permission)

<label>
<input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
{{ $permission->name }}
</label><br>

@endforeach