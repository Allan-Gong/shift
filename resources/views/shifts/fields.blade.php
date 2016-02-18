<?php

$select_times = array();
for ( $i = 0; $i < 24; $i ++) {
    $i_padded = sprintf("%02d", $i);
    for ( $j = 0; $j < 2; $j ++) {
        if ( $j == 0 ) {
            $select_times["{$i_padded}:00"] = "{$i_padded}:00";
        } else {
            $select_times["{$i_padded}:30"] = "{$i_padded}:30";
        }
    }
}

$select_roles = array();
foreach ( $roles as $role ) {
    $select_roles[$role->id] = $role->role;
}

$select_venues = array();
foreach ( $venues as $venue ) {
    $select_venues[$venue->id] = $venue->venue;
}

$select_users = array();
foreach ( $users as $user ) {
    $select_users[$user->id] = $user->name();
}

?>

<!--- Role Field --->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role_id', $select_roles, null, ['class' => 'form-control']) !!}
</div>

<!--- Assignee Field --->
<div class="form-group col-sm-6">
    {!! Form::label('assignee', 'Assignee:') !!}
    {!! Form::select('user_id', $select_users, null, ['class' => 'form-control']) !!}
</div>

<!--- Venue Field --->
<div class="form-group col-sm-6">
    {!! Form::label('venue', 'Venue:') !!}
    {!! Form::select('venue_id', $select_venues, null, ['class' => 'form-control']) !!}
</div>

<!--- Date Field --->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!--- Start Time Field --->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::select('start_time', $select_times, null, ['class' => 'form-control']) !!}
</div>

<!--- Finish Time Field --->
<div class="form-group col-sm-6">
    {!! Form::label('finish_time', 'Finish Time:') !!}
    {!! Form::select('finish_time', $select_times, null, ['class' => 'form-control']) !!}
</div>

<!--- Clock On Field --->
<div class="form-group col-sm-6">
    {!! Form::label('clock_on', 'Clock On:') !!}
    {!! Form::select('clock_on', $select_times, null, ['class' => 'form-control']) !!}
</div>

<!--- Clock Off Field --->
<div class="form-group col-sm-6">
    {!! Form::label('clock_off', 'Clock Off:') !!}
    {!! Form::select('clock_off', $select_times, null, ['class' => 'form-control']) !!}
</div>

<!--- Status Field --->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!--- Notes Field --->
<div class="form-group col-sm-6">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('shifts.index') !!}" class="btn btn-default">Cancel</a>
</div>
