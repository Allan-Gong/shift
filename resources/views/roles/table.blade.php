<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Role</th>
			<th>Pay Rate</th>
			<th>Created At</th>
			<th>Updated At</th>
			<th>Deleted At</th>
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{!! $role->id !!}</td>
			<td>{!! $role->role !!}</td>
			<td>{!! $role->pay_rate !!}</td>
			<td>{!! $role->created_at !!}</td>
			<td>{!! $role->updated_at !!}</td>
			<td>{!! $role->deleted_at !!}</td>
            <td>
                <a href="{!! route('roles.edit', [$role->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('roles.delete', [$role->id]) !!}" onclick="return confirm('Are you sure wants to delete this Role?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>