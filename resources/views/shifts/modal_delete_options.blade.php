<div class="modal fade shift_deleting_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete repeating shift</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger hidden">
          Must select a delete option before continue!
        </div>
        <div class="radio">
          <label><input type="radio" value="1" name="shift_delete_option"><strong>Only this shift</strong>. All other shifts in the series will remain untouched.</label>
        </div>
        <div class="radio">
          <label><input type="radio" value="2" name="shift_delete_option"><strong>Following shifts</strong>. This and all the following(future) shifts in the series will be deleted.</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="shift_deleting_modal_confirm">Confirm</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->