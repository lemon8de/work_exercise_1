<?php 
    $return_body = [];
    //get post api data
    $to_delete = $_POST['to_delete'];


    //process
    require 'conn.php';

    $sql = 'DELETE FROM user_alerts WHERE id = ?';
    $stmt = $conn->prepare($sql);
    
    $deleted = 0;
    foreach ($to_delete as $value) {
        $params = array($value,);
        $stmt->execute($params);
        $deleted++;
    }

    $return_body['deleted'] = $deleted;
    $return_body['to_delete'] = $to_delete;
    $return_body['success'] = true;
    echo json_encode($return_body);
?>