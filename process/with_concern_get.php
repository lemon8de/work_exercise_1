<?php 
$sql = "SELECT from_user, contact_person FROM withconcern_masterlist";
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
        echo '
            <option value= "' . $x['contact_person'] .  '">' . $x['from_user'] . '</option>
        ';
    }
    }else{
        ;
    }
?>