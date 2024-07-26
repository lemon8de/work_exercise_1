<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/admin_bar.php';?>

<div class="content-wrapper">
    <div class="container-fluid m-1">
        <div class="card card-gray-dark card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user"></i> 1. Search Employee(s)</h3>
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
                <div class="alert alert-warning alert-dismissible" id="GeneralAlert" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                    Employee selected must be unique, make more defined search parameters to find one unique Employee.
                </div>
                <form action="" method="GET" id="SearchEmployeeForm" onsubmit="return false;">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control form-control-lg" id="EmployeeID" name="EmployeeID" placeholder="Employee ID No.(s)" value="" autofocus onkeyup="clickPress(event)" autocomplete="off">
                    </div>
                </form>
                <div class="container mt-2 mb-2">
                    <span class="text-muted">Serve this alert to these employees:</span>
                    <ul class="nav nav-pills" id="CurrentSearchParameters">
                    </ul>
                </div>
                <div class="container mt-2 mb-2">
                    <table id="SearchQueryTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Section</th>
                                <th>Position</th>
                                <th>Role</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody id="SearchQueryTableBody">
                        </tbody>
                    </table>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 mx-auto">
                            <button type="button" class="btn btn-block btn-info btn-sm" onclick="proceed()">Proceed</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-gray-dark card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user"></i> 2. Create Alert</h3>
                <!-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" id="CreateAlertCardButton" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                    </button>
                </div> -->
            </div>
            <div class="card-body" id="CreateAlertCardBody" style="display:none;">
                <div class="container">
                    <form action="" method="POST" id="CreateAlertForm" onsubmit="return false;">
                        <div class="row">
                            <div class="col-sm-3 form-group input-group-sm">
                                <label for="WithConcern">With Concern</label>
                                <select class="form-control form-control-sm" id="WithConcern" name="WithConcern">
                                    <?php include '../../process/with_concern_get.php';?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group input-group-sm">
                                <label for="AlertContent">Content</label>
                                <input type="text" class="form-control form-control-lg" id="AlertContent" name="AlertContent">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 ml-auto">
                                <button type="submit" class="btn btn-block btn-success" data-toggle="modal" data-target="#confirm_alert_post_modal">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function clickPress(event) {
        if (event.keyCode == 13) {
            var InputBox = document.getElementById("EmployeeID"); 

            var SearchQueryLength = document.getElementById("SearchQueryTable").rows.length;
            var HasDuplicate = false;

            var ListItems = document.getElementById("CurrentSearchParameters").querySelectorAll("li")
            for (let i = 0; i < ListItems.length; i++) {
                if ( InputBox.value == ListItems[i].innerText) {
                    HasDuplicate = true;
                }
            }

            if ( SearchQueryLength == 2 && !HasDuplicate) { //bizzare, the header counts
                var ListElement = document.getElementById("CurrentSearchParameters");
                var NewElement = '<li class="nav nav-item active mr-1"><a href="#" class="nav nav-link active">' + InputBox.value + '</a></li>';
                ListElement.innerHTML = NewElement + ListElement.innerHTML;
                InputBox.value = '';

                var SearchContainer = document.getElementById("SearchQueryTableBody");
                SearchContainer.innerHTML = '';

                var GeneralAlert = document.getElementById('GeneralAlert');
                GeneralAlert.style.display = 'none';

            } else {
                var GeneralAlert = document.getElementById('GeneralAlert');
                GeneralAlert.style.display = 'block';
            }
        } else {
            var EmployeeID = $('#EmployeeID').val();
            $.ajax({
                url: '../../process/employee_search_get.php',
                type: 'GET',
                data: {
                    'EmployeeID' : EmployeeID,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        var SearchContainer = document.getElementById("SearchQueryTableBody");
                        SearchContainer.innerHTML = response['innerHTML'];
                    } else {
                        //handle errors
                        //console.log("error");
                    }
                }
            });
        }
    }

    function proceed() {
        var SelectEmployeeButton = document.getElementById("SelectEmployeeButton");
        //var CreateAlertCardButton = document.getElementById("CreateAlertCardButton");
        var CreateAlertCardBody = document.getElementById("CreateAlertCardBody");
        SelectEmployeeButton.click();

        CreateAlertCardBody.style.display = 'block';
    }

    function createalert() {
        //gather employee id for query
        emp_id = [];
        var ListItems = document.getElementById("CurrentSearchParameters").querySelectorAll("li")
        for (let i = 0; i < ListItems.length; i++) {
            emp_id.push(ListItems[i].innerText);
        }

        //get the from user and content
        var from_user = document.getElementById("WithConcern").value;
        var content = document.getElementById("AlertContent").value;

        //check health
        //console.log(emp_id);
        //console.log(from_user);
        //console.log(content);

        $.ajax({
                url: '../../process/alert_post.php',
                type: 'POST',
                data: {
                    'emp_id' : emp_id,
                    'from_user' : from_user,
                    'content' : content,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        //check health
                        //console.log(response);
                        $('#confirm_alert_post_modal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Succesfully Recorded!!!',
                            text: 'Success',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        // FATAL ON LAUNCH: hardcoded web address (JAY)
                        setTimeout(() => window.location.href = "http://172.25.112.100/exercise_1/page/admin/view.php", 1000);
                    } else {
                        //handle errors
                        alert(response);
                    }
                }
            });

    }
</script>

<?php include '../../footer.php';?>