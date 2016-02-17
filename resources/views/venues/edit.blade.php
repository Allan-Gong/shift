@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Create New Venue</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($venue, ['route' => ['venues.update', $venue->id], 'method' => 'patch']) !!}

            @include('venues.fields')

            {!! Form::close() !!}
        </div>
    </div>
@endsection