<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
    <div class="container-fluid m-1">

    <div class="card card-gray-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Account Management Controls</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
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
                        <div class="col-3">
                            <a href="#" class="btn btn-success btn-block" style="height:100%;" data-toggle="modal" data-target="#new_account"><i class="fas fa-plus-circle mr-2"></i>Register Account</a>
                        </div>
                        <div class="col-3">
                            <a href="#" class="btn btn-info btn-block" style="height:100%;" onclick="export_csv('accounts_table')"><i class="fas fa-download mr-2"></i>Export Account 2</a>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-warning btn-block btn-file" onclick="fileexplorer()">
                            <form id="file_form" enctype="multipart/form-data">
                                <span><i class="fas fa-upload mr-2"></i> Import Account 2 </span><input type="file" id="file2" name="file" onchange="upload_csv()" accept=".csv" style="opacity:0; display:none;">
                            </form>
                            </button>
                        </div>
                        <div class="col-3">
                            <a href="../../process/download_template.php">
                                <button class="btn btn-secondary btn-block btn-file">
                                    <span><i class="fas fa-download mr-2"></i> Download Template </span>
                                </button>
                            </a>
                        </div>
                        <!-- body -->
                    </div>
                </div>
            </div>
        </div>


        <div class="card card-gray-dark card-outline">
            <div class="card-header">
                <h3 class="card-title">Viewing Accounts</h3>
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
                        <div class="col-sm-4 form-group">
                            <label>Employee ID</label>
                            <input type="text" class="form-control" id="EmployeeIDSearchInput" placeholder="Employee ID">
                        </div>
                        <div class="col-sm-4 form-group">
                            <label>Employee Name</label>
                            <input type="text" class="form-control" id="EmployeeNameSearchInput" placeholder="Employee Name">
                        </div>
                        <div class="col-sm-4 mt-auto form-group">
                            <button type="button" class="btn btn-block btn-primary" onclick="employeeSearch('filter_search')">Search</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 table-responsive" onscroll="debounce(viewalertscroll, 250)" id="UserTableDiv" style="height:300px; overflow:auto; display:inline-block;">
                            <?php include '../../process/user_table_get.php';?>
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
    function fileexplorer() {
        document.getElementById("file2").click();
    }

    function employeeSearch(method) {
        var employee_id = document.getElementById("EmployeeIDSearchInput").value;
        var employee_name = document.getElementById("EmployeeNameSearchInput").value;

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
            'limit_amount': limit_amount,
            'limit_offset': limit_offset, 
        };
        //check health
        console.log(request_body);
        console.log(method);

        $.ajax({
            url: '../../process/employee_search_filtered_get.php',
            type: 'GET',
            data: request_body, 
            dataType: 'json',
            success: function (response) {
                console.log("success");
            } 
        });
    }
    function usertable_click() {
        var id = this.getAttribute('id');

        //checkhealth
        console.log(id);

    }

    //new method of preventing spam, see the table div for the implementation
    function debounce(method, delay) {
        clearTimeout(method._tId);
        method._tId = setTimeout(function() {
            method();
        }, delay);
    }

    function viewalertscroll() {
        var scrollTop = document.getElementById("UserTableDiv").scrollTop;
        var scrollHeight = document.getElementById("UserTableDiv").scrollHeight;
        var offsetHeight = document.getElementById("UserTableDiv").offsetHeight;

        //check if the scroll reached the bottom
        if ((offsetHeight + scrollTop + 1) >= scrollHeight) {
            employeeSearch("load_more");
        }
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
        timer: 3000,
        timerProgressBar: true,
    })
</script>
<?php
//alerting after an api redirect
    if (isset($_SESSION['account_creation_username'])) {
        echo "
        <script>
        Toast.fire({
            icon: 'success',
            title: 'Account created with username " . $_SESSION['account_creation_username']  . " with id:  " . $_SESSION['account_creation_id'] . "',
        })
        </script>
        ";
        $_SESSION['account_creation_username'] = null;
        $_SESSION['account_creation_id'] = null;
    }
?>
