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
    </head>
    <body>

    </body>

</html>
