<?php require '../../process/login.php';
    //lockout other roles
    if ($_SESSION['role'] <> "ADMIN") {
        header("location: /exercise_1/index.php");
    }
 ?>

<!DOCTYPE html>
<lang="en">
<html>
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
        <h1>Hello <?php echo $_SESSION['name'] . ' of role ' . $_SESSION['role']?></h1>
    <form action="" method="POST">
        <button type="submit" class="btn bg-primary btn-block" name="Logout" value="Logout">Logout</button>
    </form>
    </body>
</html>