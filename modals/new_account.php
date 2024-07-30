<form action="../../process/register_account_api.php" method="POST">
<div class="modal fade bd-example-modal-xl" id="new_account" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">
          <b>Register Account</b>
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="new_account_form">
        <div class="modal-body">
        <div class="row">
            <div class="col-4">
              <label>Section:</label><label style="color: red;">*</label>
              <input type="text" id="section" name="section" maxlength="50" class="form-control" autocomplete="off" required>
            </div>
            <div class="col-4">
              <label>Position:</label><label style="color: red;">*</label>
              <input type="text" id="position" name="position" maxlength="50" class="form-control" autocomplete="off" required>
            </div>
            <div class="col-4">
              <label>User Type:</label><label style="color: red;">*</label>
              <select id="user_type" name="role" class="form-control" required>
                <option value="" disabled>Select User Type</option>
                <option value="ADMIN">Admin</option>
                <option value="USER">User</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <label>Employee No:</label><label style="color: red;">*</label>
              <input type="text" id="employee_no" name="id_number" maxlength="20" class="form-control" autocomplete="off" required>
            </div>
            <div class="col-4">
              <label>Full Name:</label><label style="color: red;">*</label>
              <input type="text" id="full_name" name="full_name" maxlength="50" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <label>Username:</label><label style="color: red;">*</label>
              <input type="text" id="username" name="username" maxlength="50" class="form-control" autocomplete="off" required>
            </div>
            <div class="col-4">
              <label>Password:</label><label style="color: red;">*</label>
              <input type="password" id="password" name="password" maxlength="50" class="form-control" autocomplete="off" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="btnAddAccount" name="CreateAccount" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
</form>