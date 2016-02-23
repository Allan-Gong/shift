@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Create / Edit a Shift</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($shift, ['route' => ['shifts.update', $shift->id], 'method' => 'patch', 'class' => 'shift_form']) !!}

            @include('shifts.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection