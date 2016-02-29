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

$select_users = array('NULL' => 'Please select ...');
foreach ( $users as $user ) {
    $select_users[$user->id] = $user->name();
}

$select_shift_types = array();
foreach ( $shift_types as $shift_type ) {
    $select_shift_types[$shift_type->id] = $shift_type->type;
}

// my_debug($shift_status);

$select_shift_status = array();
foreach ( $shift_status as $shift_status_object ) {
    $select_shift_status[$shift_status_object->id] = $shift_status_object->status;
}

$form_attributes = ['class' => 'form-control' ];
if ( $form_disabled ) {
    $form_attributes['disabled'] = 'disabled';
}


$shift_type_attributes = ['id' => 'id_of_shift_type_id'];
if ( isset($shift) ) {
    $shift_type_attributes['disabled'] = 'disabled';
}

$shift_type_attributes = array_merge($form_attributes, $shift_type_attributes);

$today = null;

if ( !isset($shift) ) {
    $today = date('Y-m-d');
}

?>

<!--- Role Field --->

<div class="form-group col-sm-6">
    {!! Form::label('shift_type', 'Type:') !!}
    {!! Form::select('shift_type_id', $select_shift_types, null, $shift_type_attributes) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::select('role_id', $select_roles, null, $form_attributes) !!}
</div>

<!--- Assignee Field --->
<div class="form-group col-sm-6">
    {!! Form::label('assignee', 'Assignee:') !!}
    {!! Form::select('user_id', $select_users, null, $form_attributes) !!}
</div>

<!--- Venue Field --->
<div class="form-group col-sm-6">
    {!! Form::label('venue', 'Venue:') !!}
    {!! Form::select('venue_id', $select_venues, null, $form_attributes) !!}
</div>

<!--- Date Field --->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', $today, $form_attributes) !!}
</div>

<!--- Start Time Field --->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::select('start_time', $select_times, '09:00', $form_attributes) !!}
</div>

<!--- Finish Time Field --->
<div class="form-group col-sm-6">
    {!! Form::label('finish_time', 'Finish Time:') !!}
    {!! Form::select('finish_time', $select_times, '17:00', $form_attributes) !!}
</div>

<!--- Clock On Field --->
<div class="form-group col-sm-6">
    {!! Form::label('clock_on', 'Clock On:') !!}
    {!! Form::select('clock_on', $select_times, null, $form_attributes) !!}
</div>

<!--- Clock Off Field --->
<div class="form-group col-sm-6">
    {!! Form::label('clock_off', 'Clock Off:') !!}
    {!! Form::select('clock_off', $select_times, null, $form_attributes) !!}
</div>

<!--- Status Field --->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('shift_status_id', $select_shift_status, null, $form_attributes) !!}
</div>

<!--- Notes Field --->
<div class="form-group col-sm-6">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::text('notes', null, $form_attributes) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
@if ( !$form_disabled )
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
@endif
    <a href="{!! route('shifts.index') !!}?week={!! $week !!}" class="btn btn-default">{{ $form_disabled ? 'Back' : 'Cancel' }}</a>
</div>

@if ( $is_repeating_shift )
<script type="text/javascript">
//<![CDATA[

$(function(){
    $(".shift_form").submit(function(event){
        event.preventDefault();
        var form = this;

        $('.shift_saving_modal').modal('show');

        $('#shift_saving_modal_confirm').click(function(){

            shift_save_option = $('input:radio[name=shift_save_option]:checked').val();

            if ( typeof shift_save_option === "undefined" ) {
                $('.alert-danger').removeClass('hidden');
                return false;
            }
            else {
                $('#id_of_shift_type_id').removeAttr('disabled');
                form.submit();
            }
        });

        return false;
    });
});

//]]>
</script>
@include('shifts.modal_save_options')
@endif