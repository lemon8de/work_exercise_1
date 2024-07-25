<?php 
    $return_body = [];

    //get post api data
    $emp_id = $_POST['emp_id'];
    $from_user = $_POST['from_user'];
    $content = $_POST['content'];

    //prepare query and insert into

    $return_body['success'] = true;
    $return_body['emp_id'] = $emp_id;
    $return_body['from_user'] = $from_user;
    $return_body['content'] = $content;

    echo json_encode($return_body);

?>