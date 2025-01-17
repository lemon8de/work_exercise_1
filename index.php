<!-- require the login.php api to do the login process -->
<?php require 'process/login.php';
    // confirming login session
    if (isset($_SESSION['username'])) {
        // choosing what redirect page the user should see
        if (($_SESSION['role'] == 'ADMIN')) {
            header('location: page/admin/dashboard.php');
            exit;
        }elseif ($_SESSION['role'] == 'USER') {
            header('location: page/user/dashboard.php');
            exit;
        }
    } else {
        ;
    }
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exercise 1</title>
        <!-- icon does not work for some reason -->
        <link rel="icon" href="dist/img/logo_ico.ico" type="image/x-icon" />

        <!-- all the imports from the plugins -->
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="dist/css/font.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Sweet Alert -->
        <link rel="stylesheet" href="plugins/sweetalert2/dist/sweetalert2.min.css">
        <style>
            .margin20 {
                margin:20px;
            }
            .colorgray {
                background-color: #e9ecef;
            }
            #widthheight200 {
                width:200px;
                height:200px;
            }
        </style>
    </head>
    <body>
        <!-- whole login box -->
        <div class="login-box mx-auto">
            <!-- split the login box as picture and the form login -->
            <div class="login-logo">
                <img src="dist/img/logo.png" id="widthheight200">
                <h2>Exercise 1: Code rewrite</h2>
            </div>
            <div class="card">
                <div class="margin20">
                    <p class="login-box-msg text-muted">Sign in to start your session</p>
                    <!-- login form complete -->
                    <form action="" method="POST" id="login_form">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="usernameInput" name="usernameInput" placeholder="Username" required>
                                <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" id="passwordInput" name="passwordInput" aria-describedby="passwordHelp" placeholder="Password" required>
                                <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
                            </div>
                            <small id="passwordHelp" class="form-text text-muted">Inquire at management for password reset</small>
                        </div>
                        <button type="submit" class="btn bg-primary btn-block" name="Login" value="Login">Login</button>
                    </form>
                    <button type="submit" class="btn bg-info btn-block mt-2" name="View_Only" value="View_Only">View Only</button>
                    <button type="submit" class="btn bg-danger btn-block mt-2" name="Work_Instruction" value="Work_Instruction">Work Instruction</button>
                </div>
            </div>
        </div>
    </body>

    <!-- third party scripts -->
    <!-- jQuery -->
    <script src="plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script type="text/javascript" src="plugins/sweetalert2/dist/sweetalert2.min.js"></script>

    <!-- there should be no script here, but ignore for now -->
</html>