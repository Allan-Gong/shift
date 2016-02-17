<?php

// $times = array(
//     '00:00' => '00:00',
//     '00:30' => '00:30',
//     '01:00' => '01:00',
//     '01:30' => '01:30',
//     '02:00' => '02:00',
//     '02:30' => '02:30',
//     '03:00' => '03:00',
//     '03:30' => '03:30',
//     '04:00' => '04:00',
//     '04:30' => '04:30',
//     '05:00' => '05:00',
//     '05:30' => '05:30',
//     '06:00' => '06:00',
//     '06:30' => '06:30',
//     '07:00' => '07:00',
//     '07:30' => '07:30',
//     '08:00' => '08:00',
//     '08:30' => '08:30',
//     '09:00' => '09:00',
//     '09:30' => '09:30',
//     '10:00' => '10:00',
//     '10:30' => '10:30',
//     '11:00' => '11:00',
//     '11:30' => '11:30',
//     '12:00' => '12:00',
//     '12:30' => '12:30',
//     '13:00' => '13:00',
//     '13:30' => '13:30',
//     '14:00' => '14:00',
//     '14:30' => '14:30',
//     '15:00' => '15:00',
//     '15:30' => '15:30',
//     '16:00' => '16:00',
//     '16:30' => '16:30',
//     '17:00' => '17:00',
//     '17:30' => '17:30',
//     '18:00' => '18:00',
//     '18:30' => '18:30',
//     '19:00' => '19:00',
//     '19:30' => '19:30',
//     '20:00' => '20:00',
//     '20:30' => '20:30',
//     '21:00' => '21:00',
//     '21:30' => '21:30',
//     '22:00' => '22:00',
//     '22:30' => '22:30',
//     '23:00' => '23:00',
//     '23:30' => '23:30',
// );

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

?>

<!--- Role Field --->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role', $select_roles, null, ['class' => 'form-control']) !!}
</div>

<!--- Assignee Field --->
<div class="form-group col-sm-6">
    {!! Form::label('assignee', 'Assignee:') !!}
    {!! Form::number('assignee', null, ['class' => 'form-control']) !!}
</div>

<!--- Venue Field --->
<div class="form-group col-sm-6">
    {!! Form::label('venue', 'Venue:') !!}
    {!! Form::select('venue', $select_venues, null, ['class' => 'form-control']) !!}
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
