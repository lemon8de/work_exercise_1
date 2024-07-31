<?php
// error_reporting(0);
require 'conn.php';
session_name('exercise_1');
session_start();

$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)) {

    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        //READ FILE
        $csvFile = fopen($_FILES['file']['tmp_name'],'r');
        // SKIP FIRST LINE
        fgetcsv($csvFile);
        // PARSE
        $error = 0;
        $created = 0;
        $updated = 0;
        while (($line = fgetcsv($csvFile)) !== false) {
            // Check if the row is blank or consists only of whitespace
            if (empty(implode('', $line))) {
                continue; // Skip blank lines
            }
            $id_number = $line[0];
            $full_name = $line[1];
            $username = $line[2];
            $password = $line[3];
            $section = $line[4];
            $position = $line[5];
            $role = $line[6];
            // CHECK IF BLANK DATA
            if ($line[0] == '' || $line[1] == '' || $line[2] == '' || $line[3] == '' || $line[4] == '' || $line[5] == '' || $line[6] == '') {
                // IF BLANK DETECTED ERROR += 1
                $error++;
            } else {
                // CHECK DATA
                $sql = "SELECT id FROM user_accounts WHERE id_number = '$line[0]' AND full_name = '$line[1]' AND username = '$line[2]' AND password = '$line[3]' AND section = '$line[4]' AND position = '$line[5]' AND role = '$line[6]'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                foreach($stmt->fetchALL() as $x){
                    $id = $x['id'];
                }

                if ($stmt->rowCount() > 0) {
                    $sql = "UPDATE user_accounts SET id_number = '$id_number', full_name = '$full_name' , username ='$username', password = '$password', section = '$section', role = '$role' WHERE id ='$id'";
                    $stmt = $conn->prepare($sql);
                    $updated++;
                    if ($stmt->execute()) {
                        $error = 0;
                    } else {
                        $error++;
                    }
                } else {
                    $sql = "INSERT INTO user_accounts(id_number, full_name, username, password, section, position, role) VALUES ('$id_number','$full_name','$username','$password','$section', '$position', '$role')";
                    $stmt = $conn->prepare($sql);
                    $created++;
                    if ($stmt->execute()) {
                        $error = 0;
                    } else {
                        $error++;
                    }
                }
            }
        }
        $conn = null;

        $_SESSION['import_account_success_created'] = strval($created);
        $_SESSION['import_account_success_updated'] = strval($updated);
        fclose($csvFile);
        header('location: ../page/admin/accounts.php');

    } else {
        echo 'CSV FILE NOT UPLOADED!';
    }
} else {
    echo 'INVALID FILE FORMAT!';
}
?>