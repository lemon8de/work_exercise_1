<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/user_bar.php';?>

<div class="content-wrapper">
    <div class="container-fluid m-1">
        <div class="row">
            <?php include '../../process/alert_get.php';?>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-gray-dark card-outlined">
                    <div class="card-header">
                        <h3 class="card-title">Employee Details</h3>
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
                        <?php include '../../process/user_get.php';?>
                        <div class="text-center">
                            <p class="text-muted">All information should be correct, changes must be done at the Account Management Page</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include '../../footer.php';?>