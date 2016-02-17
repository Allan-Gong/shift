@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Shifts</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('shifts.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($shifts->isEmpty())
            <div class="well text-center">No Shifts found.</div>
        @else
            @include('shifts.table')
        @endif
        
    </div>
@endsection