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
<lang="en">
    <head>
        <meta charset = "utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Exercise 1</title>
        <link rel="icon" href="dist/img/logo.ico" type="image/x-icon" />

        <!-- all the imports from the plugins -->
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="dist/css/font.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
    </head>
    <body>
        <!-- whole login box -->
        <div class="login-box debug-color-green mx-auto">
            <!-- split the login box as picture and the form login -->
            <div class="login-logo">
                <img src="dist/img/logo.png" id="login_logo">
                <h2>Exercise 1: Code rewrite</h2>
            </div>
            <div class="card">
                <div class="login-form">
                    <p class="login-box-msg text-muted">Sign in to start your session</p>
                    <!-- login form complete -->
                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" id="login_form">
                        <div class="form-group">
                            <label for="usernameInput">Username</label>
                            <input type="text" class="form-control" id="usernameInput" aria-describedby="usernameHelp" placeholder="Username...">
                            <!-- <small id="usernameHelp" class="form-text text-muted">Username provided on your account</small> -->
                        </div>
                        <div class="form-group">
                            <label for="passwordInput">Password</label>
                            <input type="password" class="form-control" id="passwordInput" aria-describedby="passwordHelp" placeholder="Password...">
                            <small id="passwordHelp" class="form-text text-muted">Inquire at management for password reset</small>
                        </div>
                        <button type="submit" class="btn bg-primary btn-block" name="login" value="login">Login</button>
                        <button type="submit" class="btn bg-danger btn-block" name="work_instruction" value="work_instruction">Work Instruction</button>
                    </form>
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

    <!-- there should be no script here, but ignore for now -->
</html>

<style>
    .login-form {
        margin:20px;
    }
    body {
        background-color: #e9ecef;
    }

    #login_logo {
        width:200px;
        height:200px;
    }
</style>