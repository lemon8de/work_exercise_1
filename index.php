<!-- require the login.php api to do the login process -->
 <?php require 'process/login.php'


    // confirming login session
    if (isset($_SESSION['username'])) {

        // choosing what redirect page the user should see
        if (isset($_SESSION['role'] == 'admin')) {
            header('location: page/admin/dashboard.php')
            exit;
        }elseif ($_SESSION['role'] == 'user') {
            header('location: page/user/dashboard.php')
            exit;
        }
    }
 ?>
"Hello World" 
