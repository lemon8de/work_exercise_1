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
        echo 'php elsed on the loging screen';
        echo 'possible issues is the login if statements are all falsed';
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
<h1>hello world</h1>
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
