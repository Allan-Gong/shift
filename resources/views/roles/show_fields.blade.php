<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $role->id !!}</p>
</div>

<!-- Role Field -->
<div class="form-group">
    {!! Form::label('role', 'Role:') !!}
    <p>{!! $role->role !!}</p>
</div>

<!-- Pay Rate Field -->
<div class="form-group">
    {!! Form::label('pay_rate', 'Pay Rate:') !!}
    <p>{!! $role->pay_rate !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $role->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $role->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $role->deleted_at !!}</p>
</div>

