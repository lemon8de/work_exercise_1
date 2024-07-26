<?php 
    //get post api data
    $emp_id = $_GET['emp_id'];
    $full_name = $_GET['full_name'];
    $from_user = $_GET['from_user'];

    //prepare query and insert into
    require 'conn.php';


    $return_body['emp_id'] = $emp_id;
    $return_body['full_name'] = $full_name;
    $return_body['from_user'] = $from_user;

    $return_body['success'] = true;
    echo json_encode($return_body);
?>