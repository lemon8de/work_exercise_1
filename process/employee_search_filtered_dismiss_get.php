<?php 
    //get post api data
    $emp_id = $_GET['emp_id'];
    $full_name = $_GET['full_name'];
    $from_user = $_GET['from_user'];
    $limit_amount = $_GET['limit_amount'];
    $limit_offset = $_GET['limit_offset'];
    $check_query = $_GET['check_query'];

    //prepare query and insert into
    require 'conn.php';

    $sql_partial_start = "SELECT user_alerts.id, user_alerts.id_number, user_accounts.full_name, user_alerts.from_user, user_alerts.content, withconcern_masterlist.contact_person, user_alerts.date_created, user_alerts.dismissed
      	FROM user_alerts
        LEFT JOIN user_accounts
        ON user_alerts.id_number = user_accounts.id_number
        LEFT JOIN withconcern_masterlist
        ON user_alerts.from_user = withconcern_masterlist.from_user
        WHERE 1=1";

    $sql_middle_partial = "";
    $sql_middle_partial .= !empty($emp_id) ? ' AND user_alerts.id_number LIKE "' . $emp_id . '%"' : '';
    $sql_middle_partial .= !empty($full_name) ? ' AND user_accounts.full_name LIKE "' . $full_name .'%" ' :  '';
    $sql_middle_partial .= !empty($from_user) && $from_user <> "ALL" ? ' AND user_alerts.from_user ="' . $from_user .'" ' :  '';

    $sql_partial_end = " ORDER BY user_alerts.date_created DESC LIMIT " . $limit_amount . " OFFSET " . $limit_offset;
    //column parsing + filtering + pagination
    $sql = $sql_partial_start . $sql_middle_partial . $sql_partial_end;

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $employee_list = [];

    if ($stmt->rowCount() > 0) {
    $new_table = "";
    foreach($stmt->fetchAll() as $x) {
         $new_table .= '
         <tr style="cursor:pointer;" ' . htmlspecialchars($x["content"]) . '">
            <td><input type="checkbox" id="'. $x["id"] .  '" ' . $check_query . ' onchange="checkboxfunction.call(this)"></td>
            <td>' . $x['id_number'] . '</td>
            <td>' . $x['full_name'] . '</td>
            <td>' . $x['from_user'] . '</td>
            <td>' . $x['contact_person'] . '</td>
            <td>' . $x['date_created'] . '</td>
         </tr>
         ';
         array_push($employee_list,$x['id']);
     }

     }else{
     ;
     }

    $return_body['success'] = true;
    $return_body['row_count'] = $stmt->rowCount();
    $return_body['new_table'] = !empty($new_table) ? $new_table : "";
    $return_body['check_query'] = $check_query;
    $return_body['emp_id'] = $employee_list;
    $return_body['query'] = $sql;
    echo json_encode($return_body);
?>