<?php 

    require 'conn.php'; 
    //generate dictionary to return
    $return_body = [];
    //get api data
    $emp_id = $_GET['EmployeeID'];
    $emp_id .= "%";

    //database lookup
    $sql = "SELECT id_number, full_name, section, position, role, username from user_accounts where id_number like ? LIMIT 10";
    $stmt = $conn->prepare($sql);
    $params = array($emp_id,);
    $stmt->execute($params);

    $return_body['innerHTML'] = "";
    if ($stmt->rowCount() > 0) {
        foreach($stmt->fetchAll() as $x) {
            $return_body['innerHTML'] .= "
                <tr>
                    <td>" . $x['id_number'] . "</td>
                    <td>" . $x['full_name'] . "</td>
                    <td>" . $x['section'] . "</td>
                    <td>" . $x['position'] . "</td>
                    <td>" . $x['role'] . "</td>
                    <td>" . $x['username'] . "</td>
                </tr>
            ";
        }
    }else{
        ;
    }

    $return_body['success'] = true;
    echo json_encode($return_body);
?>