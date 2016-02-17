@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Venues</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('venues.create') !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @if($venues->isEmpty())
            <div class="well text-center">No Venues found.</div>
        @else
            @include('venues.table')
        @endif
        
    </div>
@endsection