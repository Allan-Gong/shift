<!--- Id Field --->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'Id:') !!}
    {!! Form::number('id', null, ['class' => 'form-control']) !!}
</div>

<!--- Role Field --->
<div class="form-group col-sm-6">
    {!! Form::label('role', 'Role:') !!}
    {!! Form::number('role', null, ['class' => 'form-control']) !!}
</div>

<!--- Assignee Field --->
<div class="form-group col-sm-6">
    {!! Form::label('assignee', 'Assignee:') !!}
    {!! Form::number('assignee', null, ['class' => 'form-control']) !!}
</div>

<!--- Venue Field --->
<div class="form-group col-sm-6">
    {!! Form::label('venue', 'Venue:') !!}
    {!! Form::number('venue', null, ['class' => 'form-control']) !!}
</div>

<!--- Start Time Field --->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::date('start_time', null, ['class' => 'form-control']) !!}
</div>

<!--- Finish Time Field --->
<div class="form-group col-sm-6">
    {!! Form::label('finish_time', 'Finish Time:') !!}
    {!! Form::date('finish_time', null, ['class' => 'form-control']) !!}
</div>

<!--- Clock On Field --->
<div class="form-group col-sm-6">
    {!! Form::label('clock_on', 'Clock On:') !!}
    {!! Form::date('clock_on', null, ['class' => 'form-control']) !!}
</div>

<!--- Clock Off Field --->
<div class="form-group col-sm-6">
    {!! Form::label('clock_off', 'Clock Off:') !!}
    {!! Form::date('clock_off', null, ['class' => 'form-control']) !!}
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

<!--- Created At Field --->
<div class="form-group col-sm-6">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!--- Updated At Field --->
<div class="form-group col-sm-6">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>

<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('shifts.index') !!}" class="btn btn-default">Cancel</a>
</div>
