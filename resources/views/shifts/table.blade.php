<?php

// $role = $shifts[0]->role();

// print_r($role);


// foreach($shifts as $shift) {
//   $role = $shift->role();
//   print_r($role);
// }
?>

<table class="table table-responsive">
    <thead>
    <th>Id</th>
			<th>Role</th>
			<th>Assignee</th>
			<th>Venue</th>
      <th>Date</th>
			<th>Start Time</th>
			<th>Finish Time</th>
			<th>Clock On</th>
			<th>Clock Off</th>
			<th>Status</th>
			<th>Notes</th>
			<!-- <th>Created At</th> -->
			<!-- <th>Updated At</th> -->
    <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($shifts as $shift)
        <tr>
          <td>{!! $shift->id !!}</td>
    			<td>{!! $shift->role->role !!}</td>
    			<td>{!! $shift->user->name() !!}</td>
    			<td>{!! $shift->venue->vanue !!}</td>
          <td>{!! $shift->date !!}</td>
    			<td>{!! $shift->start_time !!}</td>
    			<td>{!! $shift->finish_time !!}</td>
    			<td>{!! $shift->clock_on !!}</td>
    			<td>{!! $shift->clock_off !!}</td>
    			<td>{!! $shift->status !!}</td>
    			<td>{!! $shift->notes !!}</td>
			<!-- <td>{!! $shift->created_at !!}</td> -->
			<!-- <td>{!! $shift->updated_at !!}</td> -->
          <td>
              <a href="{!! route('shifts.edit', [$shift->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
              <a href="{!! route('shifts.delete', [$shift->id]) !!}" onclick="return confirm('Are you sure wants to delete this Shift?')">
                  <i class="glyphicon glyphicon-trash"></i>
              </a>
          </td>
        </tr>
    @endforeach
    </tbody>
</table>