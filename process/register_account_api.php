<?php 
    session_name("exercise_1");
    session_start();

    require 'conn.php';
    //get post api data
    $id_number = $_POST['id_number'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $section = $_POST['section'];
    $position = $_POST['position'];
    $role = $_POST['role'];

    $sqlselect = "SELECT id from user_accounts WHERE username = '$username'";
    $stmt = $conn->prepare($sqlselect);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo 'duplicate account';
        exit;
    }
    $stmt = null;

    $sqlinsert = "INSERT INTO user_accounts (id_number, full_name, username, password ,section, position, role) 
    VALUES ('$id_number','$full_name','$username', '$password', '$section', '$position', '$role')";
    $stmt = $conn->prepare($sqlinsert);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo 'account created';
    }
    $conn = null;


    $_SESSION['account_creation_username'] = $username;
    $_SESSION['account_creation_id'] = $id_number;
    header('location: ../page/admin/accounts.php');
?>