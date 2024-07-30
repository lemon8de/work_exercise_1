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
                            <a href="../../process/exp_accounts3.php" class="btn btn-info btn-block" style="height:100%;"><i class="fas fa-download mr-2"></i>Export Account 2</a>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-warning btn-block btn-file" onclick="fileexplorer()">
                            <form id="file_form" enctype="multipart/form-data" action="../../process/imp_accounts2.php" method="POST">
                                <span><i class="fas fa-upload mr-2"></i> Import Account 2 </span><input type="file" id="file2" name="file" onchange="submit()" accept=".csv" style="opacity:0; display:none;">
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
                <div class="container" id="TableDiv">
                    <div class="row" id="Table1Div">
                        <div class="col-sm-12 table-responsive" id="UserTableDiv" style="height:300px; overflow:auto; display:inline-block;">
                            <?php include '../../process/user_table_get.php';?>
                        <!--  ending div of col at the include -->
                    </div>
                        <div class="row" id="Table2Div">
                            <div class="col-sm-12 table-responsive" id="UserTableAlertDiv" style="height:300px; overflow:auto; display:inline-block;">
                                <?php include '../../process/user_table_tableswitch_get.php';?>
                            <!--  ending div of col at the include -->
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
    function usertable_click() {
        var id = this.getAttribute('id');

        //checkhealth
        //console.log(id);

        //api here
        $.ajax({
            url: '../../process/generate_tableswitch_content.php',
            type: 'GET',
            data: {
                'id' : id,
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    document.getElementById('UserTableViewBody2').innerHTML = response.new_table;
                } else {
                    //handle errors
                    //console.log("error");
                }
            }
        });
    }
</script>
<?php include '../../footer.php';?>