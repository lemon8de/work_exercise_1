<?php 
//starting sessions
session_name("exercise_1");
session_start();

//database connection
include 'conn.php';

// onclick of the login button with name and ID 'login'
if (isset($_POST['login'])) {
    echo 'hello';
}else {
    ;
}




?>
