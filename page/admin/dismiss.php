<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
    <div class="container-fluid m-1">
        <div class="card card-gray-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Delete Alerts</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" id="SelectEmployeeButton" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
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
                                <option value="ALL">All Departments</option>
                                <?php include '../../process/with_concern_get.php';?>
                            </select>
                        </div>
                        <div class="col-sm-3 mt-auto form-group">
                            <button type="button" class="btn btn-block btn-primary" onclick="employeeSearch('filter_search')">Search</button>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <!-- <div class="col-sm-3 form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" id="StartDateSearchInput">
                        </div>
                        <div class="col-sm-3 form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control" id="EndDateSearchInput">
                        </div>
                        <div class="col-sm-3 form-group">
                        </div> -->
                        <div class="col-sm-3 form-group mt-auto">
                            <button type="button" class="btn btn-block btn-danger" onclick="alertdelete()">Delete</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 table-responsive" onscroll="debounce(viewalertscroll, 250)" id="AlertTableDiv" style="height:300px; overflow:auto; display:inline-block;">
                            <?php include '../../process/alert_table_dismiss_get.php';?>
                        <!--  ending div of col at the include -->
                    </div>
                    <div class="row">
                    <div class="col-sm-12 alert alert-info alert-dismissible" id="LoadMoreAlert" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Maximum Reached!</h5>
                        Now Viewing All Queried Alerts
                        </div>
                    </div>
                    <div class="row mt-1 mb-1">
                        <div class="col-sm-2 mx-auto">
                            <button type="button" class="btn btn-block btn-secondary" id="LoadMoreButton" onclick="employeeSearch('load_more')">Load More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    var checked_list = [];
    function alertdelete() {

        if (checked_list.length == 0) {
            alert("nothing selected");
            return 0
        }
        request_body = {
            'to_delete' : checked_list,
        };

        $.ajax({
            url: '../../process/delete_alerts_api.php',
            type: 'POST',
            data: request_body, 
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    //console.log(response);
                    employeeSearch('filter_search');
                    Toast.fire({
                        icon: 'success',
                        title: 'Deletion successful',
                    })
                }
            }
        });
    }
    function checkboxfunction() {
        //console.log(this.id);
        var is_checked = $(this).is(":checked");

        if (is_checked) {
            checked_list.push(this.id);
        } else {
            checked_list.splice(checked_list.indexOf(this.id), 1);
        }
        //console.log(checked_list);
    }
    function employeeSearch(method) {
        var employee_id = document.getElementById("EmployeeIDSearchInput").value;
        var employee_name = document.getElementById("EmployeeNameSearchInput").value;
        var with_concern = document.getElementById("WithConcernSearchInput").value;
        var isall_checked = $("#SelectAllCheckBox").is(":checked");

        if (method == "filter_search") {
            checked_list.length = 0;
            //have to clear all checkboxes
            var checkboxes = $("#AlertTableDiv").closest('table').find(':checkbox');
            //remove the check on the select all, the search api actually posts unchecked rows so no need to reset those aswell
            $("#SelectAllCheckBox").prop("checked", false);

            var limit_amount = 50;
            var limit_offset = 0;

            //prevent checked boxes when you click search
            var check_query = "";
        }else if (method == "load_more") {
            //console.log(document.getElementById("CurrentLoadedPagination"));
            var limit_amount = 50;
            var current_loaded = parseInt(document.getElementById("CurrentLoadedPagination").innerText);
            var limit_offset = current_loaded;
            //console.log(limit_amount, limit_offset)

            if (isall_checked) {
                var check_query = "checked";
            } else {
                var check_query = "";
            }
        }

        request_body = {
            'emp_id': employee_id,
            'full_name': employee_name,
            'from_user': with_concern,
            'limit_amount': limit_amount,
            'limit_offset': limit_offset, 
            'check_query': check_query,
        };
        //check health
        //console.log(request_body);
        //console.log(method);

        $.ajax({
            url: '../../process/employee_search_filtered_dismiss_get.php',
            type: 'GET',
            data: request_body, 
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    //console.log(response);
                    if (method == "filter_search") {
                        //console.log("searched method filter");
                        document.getElementById("AlertTableViewBody").innerHTML = response.new_table;
                        //system critical on the debug menu
                        document.getElementById("CurrentLoadedPagination").innerText = response.row_count;
                        document.getElementById("AlertTableViewCount").innerHTML = "Showing " + response.row_count + " results";

                    }else if (method == "load_more") {
                        document.getElementById("AlertTableViewBody").insertAdjacentHTML('beforeend', response.new_table);
                        document.getElementById("AlertTableViewCount").innerHTML = "Showing " + (parseInt(document.getElementById("CurrentLoadedPagination").innerText) + response.row_count) + " results";
                        //system critical on the debug menu
                        document.getElementById("CurrentLoadedPagination").innerHTML = parseInt(document.getElementById("CurrentLoadedPagination").innerText) + response.row_count;

                        //console.log(response.emp_id);
                        response.emp_id.forEach((element) => $("#" + element).trigger('change'));

                        if (response.row_count == 0) {
                            document.getElementById("LoadMoreButton").style.display = "none";
                            document.getElementById("LoadMoreAlert").style.display = "inline-block";
                        }
                    }
                } else {
                    //handle errors
                    ;
                }
            }
        });
    }

    //new method of preventing spam, see the table div for the implementation
    function debounce(method, delay) {
        clearTimeout(method._tId);
        method._tId = setTimeout(function() {
            method();
        }, delay);
    }

    function viewalertscroll() {
        var scrollTop = document.getElementById("AlertTableDiv").scrollTop;
        var scrollHeight = document.getElementById("AlertTableDiv").scrollHeight;
        var offsetHeight = document.getElementById("AlertTableDiv").offsetHeight;

        //check if the scroll reached the bottom
        if ((offsetHeight + scrollTop + 1) >= scrollHeight) {
            employeeSearch("load_more");
        }
    }

    function allchecked() {
        checked_list.length = 0;
        var checkboxes = $(this).closest('table').find(':checkbox');
        checkboxes.prop('checked', $(this).is(':checked'));
        checkboxes.trigger('change');
    }
</script>

<?php include '../../footer.php';?>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        customClass: {
            popup: 'colored-toast',
        },
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    })
</script>