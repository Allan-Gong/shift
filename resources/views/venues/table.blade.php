<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Venue</th>
			<th>Address</th>
			<!-- <th>Created At</th> -->
			<!-- <th>Updated At</th> -->
			<!-- <th>Deleted At</th> -->
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($venues as $venue)
        <tr>
            <td>{!! $venue->id !!}</td>
			<td>{!! $venue->venue !!}</td>
			<td>{!! $venue->address !!}</td>
			<!-- <td>{!! $venue->created_at !!}</td> -->
			<!-- <td>{!! $venue->updated_at !!}</td> -->
			<!-- <td>{!! $venue->deleted_at !!}</td> -->
            <td>
                <a href="{!! route('venues.edit', [$venue->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('venues.delete', [$venue->id]) !!}" onclick="return confirm('Are you sure wants to delete this Venue?')">
                    <i class="glyphicon glyphicon-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>