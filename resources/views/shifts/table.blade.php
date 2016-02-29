<table class="table table-responsive">
    <thead>
      <th>Id</th>
			<th>Role</th>
			<th>Assignee</th>
			<th>Venue</th>
      <th>Date</th>
			<th>Start Time</th>
			<th>Finish Time</th>
			<th>Clock On</th>
			<th>Clock Off</th>
			<th>Status</th>
			<th>Notes</th>
			<!-- <th>Created At</th> -->
			<!-- <th>Updated At</th> -->
      <th width="50px">Action</th>
    </thead>
    <tbody>
    @if( $shifts->isEmpty() )
      <tr><td colspan="12"><div class="well text-center">No Shifts found.</div></td></tr>
    @else
      @foreach($shifts as $shift)
          <?php $is_repeating_shift = $shift->is_repeating(); ?>
          <?php $repeating_shift_class_attribute = $is_repeating_shift ? 'class="bg-info"' : ''; ?>
          <tr <?php echo $repeating_shift_class_attribute; ?>>
            <td>{!! $shift->id !!}</td>
      			<td>{!! $shift->get_role_string() !!}</td>
      			<td>{!! $shift->get_user_string() !!}</td>
      			<td>{!! $shift->get_venue_string() !!}</td>
            <td>{!! $shift->date !!}</td>
      			<td>{!! $shift->start_time !!}</td>
      			<td>{!! $shift->finish_time !!}</td>
      			<td>{!! $shift->clock_on !!}</td>
      			<td>{!! $shift->clock_off !!}</td>
      			<td>{!! $shift->get_status_string() !!}</td>
      			<td>{!! $shift->notes !!}</td>
            <td>
                <a href="{!! route('shifts.edit', [$shift->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                {!! Form::model($shift, ['route' => ['shifts.delete', $shift->id], 'method' => 'post', 'class' => 'shift_delete_form', 'style' => 'display: inline;']) !!}
                <button style="float: right; display: inline; border: none; background: transparent;" type="submit" class="btn_delete_shift <?php echo $is_repeating_shift ? 'btn_delete_repeating_shift' : 'btn_delete_standalone_shift'; ?>">
                    <i class="glyphicon glyphicon-trash"></i>
                </button>
                {!! Form::close() !!}
            </td>
          </tr>
      @endforeach
    @endif
    </tbody>
</table>

<script type="text/javascript">
//<![CDATA[

$(function(){
    $('.btn_delete_standalone_shift').click(function(event){
      event.preventDefault();
      event.stopPropagation();

      return confirm('Are you sure to delete this Shift ?');
    });

    $('.btn_delete_repeating_shift').click(function(event){
      event.preventDefault();
      event.stopPropagation();

      var $form = $(this).parent('.shift_delete_form');

      $('.shift_deleting_modal').modal('show');

      $('#shift_deleting_modal_confirm').click(function(){
          shift_delete_option = $('input:radio[name=shift_delete_option]:checked').val();

          if ( typeof shift_delete_option === "undefined" ) {
            $('.alert-danger').removeClass('hidden');
            return false;
          }
          else
          {
            var input = $("<input>")
              .attr("type", "hidden")
              .attr("name", "shift_delete_option").val(shift_delete_option)
            ;

            $form.append($(input));
            $form.submit();
          }
      });

      return false;
    });
});

//]]>
</script>
@include('shifts.modal_delete_options')