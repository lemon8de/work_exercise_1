<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
    <div class="container-fluid m-1">
        <div class="row">
                <div class="col-sm-12">
                    <div class="card card-gray-dark card-outlined">
                        <div class="card-header">
                            <h3 class="card-title">Viewing Alerts</h3>
                            <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                    <i class="fas fa-expand"></i>
                                </button>
                            </div> -->
                        </div>
                        <div class="card body m-2 card-outlined pl-4 pt-1" style="display:block">
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-sm-3 form-group">
                                        <label>Employee ID</label>
                                        <input type="text" class="form-control" id="EmployeeIDSearchInput" placeholder="Employee ID">
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>Employee Name</label>
                                        <input type="text" class="form-control" id="EmployeeNameSearchInput" placeholder="Employee Name">
                                    </div>
                                    <div class="col-sm-3 form-group">
                                        <label>With Concern</label>
                                        <select class="form-control" id="WithConcernSearchInput">
                                            <option value="" selected disabled>Select</option>
                                            <?php include '../../process/with_concern_get.php';?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mt-auto form-group">
                                        <button type="button" class="btn btn-block btn-primary" onclick="employeeSearch()">Search</button>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-inline text-muted">
                                    <div class="form-group">
                                        <p>--Pagination Debug Tab-- &nbsp;&nbsp;</p>
                                    </div>
                                    <div class="form-group">
                                        <p>Load More Iterations=</p>
                                        <p id="LoadMoreIterationPagination">0</p>
                                        <p>&nbsp;|&nbsp;</p>
                                    </div>
                                    <div class="form-group">
                                        <p>Current Loaded=</p>
                                        <p id="CurrentLoadedPagination">20</p>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 table-responsive" style="height:300px; overflow:auto; display:inline-block;">
                                        <?php include '../../process/alert_table_get.php';?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function employeeSearch() {
        var employee_id = document.getElementById("EmployeeIDSearchInput").value;
        var employee_name = document.getElementById("EmployeeNameSearchInput").value;
        var with_concern = document.getElementById("WithConcernSearchInput").value;

        request_body = {
            'emp_id': employee_id,
            'full_name': employee_name,
            'from_user': with_concern,
        };
        //check health
        //console.log(request_body);

        $.ajax({
            url: '../../process/employee_search_filtered_get.php',
            type: 'GET',
            data: request_body, 
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    console.log("S");
                    console.log(response);
                } else {
                    //handle errors
                    console.log("error");
                    console.log(response);
                }
            }
        });
    }
    function alert_table_click() {
        console.log(this);
        content = [];
        alert_content = this.getAttribute('custom-content');
        var contentItems = this.querySelectorAll("td")
        for (let i = 0; i < contentItems.length; i++) {
            content.push(contentItems[i].innerText);
        }
        //checkhealth
        console.log(content);
        console.log(alert_content);

        //apply to modal
        document.getElementById("DateAlertTableViewModal").innerText = content[4];
        document.getElementById("EmployeeID-alert-tvm").value = content[0];
        document.getElementById("WithConcern-alert-tvm").value = content[2];
        document.getElementById("ContactPerson-alert-tvm").value = content[3];
        document.getElementById("Content-alert-tvm").value = alert_content;
    }
</script>

<?php include '../../footer.php';?>