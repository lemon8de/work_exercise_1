<!-- Modal -->
<form action="../../process/alert_table_click_modal_api.php" method="POST">
<div class="modal fade" id="alert_table_click_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body container">
        <h5 id="DateAlertTableViewModal"style="text-align:center;">.the date.</h5>
        <!-- hidden -->
        <input type="hidden" class="form-control" id="IdAlertTableViewModal" name="id" readonly>
        <!-- end hidden -->

        <div class="row">
          <div class="col-sm-12 form-group">
            <label for="EmployeeIDAlertTableViewModal">EmployeeID</label>
            <input type="text" class="form-control" id="EmployeeID-alert-tvm" name="employee_id" placeholder="EmployeeID" readonly>
            <small id="EmployeeIDAlertTableViewModalHelp" class="form-text text-muted">The system does not allow Employee ID Change.</small>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 form-group">
            <label for="WithConcernAlertTableViewModal">With Concern</label>
            <select class="form-control form-control" id="WithConcern-alert-tvm" name="from_user" onchange="withconcernupdate()">
              <?php include '../../process/with_concern_get.php';?>
            </select>
          </div>
          <div class="col-sm-6 form-group">
            <label for="ContactPersonAlertTableViewModal">Contact Person</label>
            <input type="text" class="form-control" id="ContactPerson-alert-tvm" name="contact_person" placeholder="The Person it did Mayed" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 form-group">
            <label for="ContentAlertTableViewModal">Alert Content</label>
            <input type="text" class="form-control" id="Content-alert-tvm" name="content" placeholder="What Concerns the User">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="update">Update</button>
        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>

<script>
  function withconcernupdate() {
    document.getElementById('ContactPerson-alert-tvm').value = document.getElementById('WithConcern-alert-tvm').value;
  }
</script>