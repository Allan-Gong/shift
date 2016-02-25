@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Shifts</h1>
        <div class="clearfix"></div>
        <p><strong>Week: {!! $monday !!} to {!! $sunday !!}</strong></p>
        <div class="clearfix"></div>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('shifts.create') . "?week={$week}" !!}">Add New</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @include('shifts.table')
        @include('shifts.pagination')

    </div>
@endsection