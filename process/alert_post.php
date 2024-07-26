<?php 
    $return_body = [];
    //get post api data
    $emp_id = $_POST['emp_id'];
    $from_user = $_POST['from_user'];
    $content = $_POST['content'];

    //prepare query and insert into
    require 'conn.php';
    $count = 0;
    foreach ($emp_id as $emp_id_user) {
        $sql_query = "INSERT INTO user_alerts (id_number, from_user, content) VALUES ('$emp_id_user', '$from_user', '$content')";
        $stmt = $conn->prepare($sql_query);
        $stmt->execute();
        $count++;
    }

    $return_body['emp_id'] = $emp_id;
    $return_body['success'] = true;
    $return_body['insertions'] = $count;
    echo json_encode($return_body);

?>