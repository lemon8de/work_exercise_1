<?php 
    session_name("exercise_1");
    session_start();

    require 'conn.php';

    $id = $_POST['id'];
    $employee_id = $_POST['employee_id'];

    //this is a stupid since from_user and contact_person will output the same thing (lack of foresight when making form)
    //we just have to play our cards and use the contact person master list to parse this
    //this forced my hand, i don't want to edit this to be cleaner
    $from_user = $_POST['from_user'];
    $contact_person = $_POST['contact_person'];
    $content = $_POST['content'];

    if (isset($_POST['update'])) {
        //check what the from_user should be, again this is the part where the modal fucked up
        $sql = "SELECT from_user FROM withconcern_masterlist WHERE contact_person = '$contact_person'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        foreach($stmt->fetchAll() as $x) {
            $parsed_from_user = $x['from_user'];
        }
        $sql = "UPDATE user_alerts SET from_user = '$parsed_from_user', content = '$content' WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $conn = null;
        $_SESSION['alert_update_success'] = "Alert Successfully updated";
        header('location: ../page/admin/view.php');

    } else if (isset($_POST['delete'])) {
        //check what the from_user should be, again this is the part where the modal fucked up
        $sql = "DELETE FROM user_alerts WHERE id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $_SESSION['alert_update_success'] = "Alert Successfully deleted";
        header('location: ../page/admin/view.php');
        echo $id;
    }
?>