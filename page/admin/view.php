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
                                            <option value="ALL">All Departments</option>
                                            <?php include '../../process/with_concern_get.php';?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 mt-auto form-group">
                                        <button type="button" class="btn btn-block btn-primary" onclick="employeeSearch('filter_search')">Search</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 table-responsive" onscroll="debounce(viewalertscroll, 250)" id="AlertTableDiv" style="height:300px; overflow:auto; display:inline-block;">
                                        <?php include '../../process/alert_table_get.php';?>
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
        </div>
    </div>
</div>

<script>
    function employeeSearch(method) {
        console.log('asdf');
        var employee_id = document.getElementById("EmployeeIDSearchInput").value;
        var employee_name = document.getElementById("EmployeeNameSearchInput").value;
        var with_concern = document.getElementById("WithConcernSearchInput").value;

        if (method == "filter_search") {
            var limit_amount = 50;
            var limit_offset = 0;
        }else if (method == "load_more") {
            //console.log(document.getElementById("CurrentLoadedPagination"));
            var limit_amount = 50;
            var current_loaded = parseInt(document.getElementById("CurrentLoadedPagination").innerText);
            var limit_offset = current_loaded;
            //console.log(limit_amount, limit_offset)
        }

        request_body = {
            'emp_id': employee_id,
            'full_name': employee_name,
            'from_user': with_concern,
            'limit_amount': limit_amount,
            'limit_offset': limit_offset, 
        };
        //check health
        //console.log(request_body);
        //console.log(method);

        $.ajax({
            url: '../../process/employee_search_filtered_get.php',
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
    function alert_table_click() {
        //console.log(this);
        content = [];
        alert_content = this.getAttribute('custom-content');
        var contentItems = this.querySelectorAll("td")
        for (let i = 0; i < contentItems.length; i++) {
            content.push(contentItems[i].innerText);
        }
        //checkhealth
        //console.log(content);
        //console.log(alert_content);

        //apply to modal
        document.getElementById("DateAlertTableViewModal").innerText = content[4];
        document.getElementById("EmployeeID-alert-tvm").value = content[0];
        document.getElementById("WithConcern-alert-tvm").value = content[2];
        document.getElementById("ContactPerson-alert-tvm").value = content[3];
        document.getElementById("Content-alert-tvm").value = alert_content;
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
</script>

<?php include '../../footer.php';?>