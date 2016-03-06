@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="pull-left">Notice Board</h1>
        <div class="clearfix"></div>
        <p><strong>Week: {!! $monday !!} to {!! $sunday !!}</strong></p>
        <div class="clearfix"></div>

        <div class="clearfix"></div>

        <table class="table table-responsive">
            <thead>
            <th>Role</th>
            <th>Assignee</th>
            <th>Venue</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Finish Time</th>
            <th>Notes</th>
            <!-- <th>action</th> -->
            </thead>
            <tbody>
            @if( $shifts->isEmpty() )
                <tr><td colspan="12"><div class="well text-center">No Shifts found.</div></td></tr>
            @else
                @foreach($shifts as $shift)
                    <?php $is_repeating_shift = $shift->is_repeating(); ?>
                    <?php $repeating_shift_class_attribute = $is_repeating_shift ? 'class="bg-info"' : ''; ?>
                    <tr <?php echo $repeating_shift_class_attribute; ?>>
                        <td>{!! $shift->get_role_string() !!}</td>
                        <td>{!! $shift->get_user_string() !!}</td>
                        <td>{!! $shift->get_venue_string() !!}</td>
                        <td>{!! $shift->date !!}</td>
                        <td>{!! $shift->start_time !!}</td>
                        <td>{!! $shift->finish_time !!}</td>
                        <td>{!! $shift->notes !!}</td>
                        <!--
                        <td>
                            <a title="Apply this shift" href="{!! route('shifts.show', [$shift->id]) !!}"><i class="glyphicon glyphicon-user"></i></a>
                        </td>
                        -->

                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        @include('shifts.pagination')
    </div>
@endsection
