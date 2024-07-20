<?php 
//starting sessions
session_name("exercise_1");
session_start();

//database connection
include 'conn.php';

// onclick of the login button with name and ID 'login'
if (isset($_POST['Login'])) {

    //get the information sent by the form
    $username = $_POST['usernameInput'];
    $password = $_POST['passwordInput'];

    //prepare the query
    $sql = "SELECT id_number, full_name, section, position, role FROM user_accounts WHERE BINARY username = ? AND BINARY password = ?";
    // from what i can deduce, we will take these columns from the user accounts table, WHERES to pinpoint the exact 'row' or data log, the ? are just placeholders for the next lines of code
    // link the sql query and the sql database together??
    $stmt = $conn->prepare($sql);
    $params = array($username, $password);
    //the two ? at the sql are probably replaced here at execute params
    $stmt->execute($params);
    //check if we got a hit on the table, meaning the user submitted valid username and password
    if ($stmt->rowCount() > 0) {
        //there is a foreach here because this might return an array or something, but honestly this will only run once
        foreach($stmt->fetchAll() as $x) {
            $_SESSION['username'] = $username;
            $_SESSION['id_number'] = $x['id_number'];
            $_SESSION['name'] = $x['full_name'];
            $_SESSION['section'] = $x['section'];
            $_SESSION['position'] = $x['position'];
            $_SESSION['role'] = $x['role'];

            //this the last check to know where to send the user
            if ($role == 'ADMIN') {
                header('location: page/admin/dashboard.php');
                exit;
            } elseif ($role == 'USER') {
                header('location: page/user/dashboard.php');
                exit;
            }
        } 
    }else{
        //why does this not work?
        echo "
        <script>
            Swal.fire({
                title: 'Error!',
                text: 'Do you want to continue',
                icon: 'error',
                confirmButtonText: 'Cool'
            });
        </script>
        ";
    }

} else {
    ;
}

//logout code, called by a button with name Logout
if (isset($_POST['Logout'])) {
    session_unset();
    session_destroy();
    header('location: /exercise_1/');
    exit;
} else {
    ;
}
?>