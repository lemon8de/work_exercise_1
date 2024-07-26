<!-- Modal -->
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
        <div class="row">
          <div class="col-sm-12 form-group">
            <label for="EmployeeIDAlertTableViewModal">EmployeeID</label>
            <input type="text" class="form-control" id="EmployeeID-alert-tvm" placeholder="EmployeeID" readonly>
            <small id="EmployeeIDAlertTableViewModalHelp" class="form-text text-muted">The system does not allow Employee ID Change.</small>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 form-group">
            <label for="WithConcernAlertTableViewModal">With Concern</label>
            <select class="form-control form-control" id="WithConcern-alert-tvm" name="WithConcern-alert-tvm">
              <?php include '../../process/with_concern_get.php';?>
            </select>
          </div>
          <div class="col-sm-6 form-group">
            <label for="ContactPersonAlertTableViewModal">Contact Person</label>
            <input type="text" class="form-control" id="ContactPerson-alert-tvm" placeholder="The Person it did Mayed" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 form-group">
            <label for="ContentAlertTableViewModal">Alert Content</label>
            <input type="text" class="form-control" id="Content-alert-tvm" placeholder="What Concerns the User">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updateAlert()">Update</button>
        <button type="button" class="btn btn-danger" onclick="deleteAlert()">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>