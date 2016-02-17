<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $shift->id !!}</p>
</div>

<!-- Role Field -->
<div class="form-group">
    {!! Form::label('role', 'Role:') !!}
    <p>{!! $shift->role->role !!}</p>
</div>

<!-- Assignee Field -->
<div class="form-group">
    {!! Form::label('assignee', 'Assignee:') !!}
    <p>{!! $shift->assignee->email !!}</p>
</div>

<!-- Venue Field -->
<div class="form-group">
    {!! Form::label('venue', 'Venue:') !!}
    <p>{!! $shift->venue->venue !!}</p>
</div>

<!-- Start Time Field -->
<div class="form-group">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{!! $shift->start_time !!}</p>
</div>

<!-- Finish Time Field -->
<div class="form-group">
    {!! Form::label('finish_time', 'Finish Time:') !!}
    <p>{!! $shift->finish_time !!}</p>
</div>

<!-- Clock On Field -->
<div class="form-group">
    {!! Form::label('clock_on', 'Clock On:') !!}
    <p>{!! $shift->clock_on !!}</p>
</div>

<!-- Clock Off Field -->
<div class="form-group">
    {!! Form::label('clock_off', 'Clock Off:') !!}
    <p>{!! $shift->clock_off !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $shift->status !!}</p>
</div>

<!-- Notes Field -->
<div class="form-group">
    {!! Form::label('notes', 'Notes:') !!}
    <p>{!! $shift->notes !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $shift->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $shift->updated_at !!}</p>
</div>

