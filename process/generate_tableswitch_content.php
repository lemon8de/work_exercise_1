<?php 
    session_name('exercise_1');
    session_start();

    $return_body = [];
    //get post api data
    $id = $_GET['id'];

    //prepare query and insert into
    require 'conn.php';

    $sql = "SELECT user_alerts.from_user, withconcern_masterlist.contact_person, user_alerts.content, user_alerts.date_created
        FROM user_accounts
        LEFT JOIN user_alerts
        ON user_accounts.id_number = user_alerts.id_number
        LEFT JOIN withconcern_masterlist
        ON user_alerts.from_user = withconcern_masterlist.from_user
        WHERE user_accounts.id = ?";
    
    $stmt = $conn->prepare($sql);
    $params = array($id,);
    $stmt->execute($params);
    $conn = null;

    $inner_html = "";
    $table_empty = true;
    if ($stmt->rowCount() > 1) {
        $table_empty = false;
        foreach($stmt->fetchAll() as $x) {
            $inner_html .= '
            <tr style="cursor:pointer;">
                <td>' . $x["from_user"] . '</td>
                <td>' . $x["contact_person"] . '</td>
                <td>' . $x["content"] . '</td>
                <td>' . $x["date_created"] . '</td>
            </tr>
            ';
        }
        
    }else{
        ;
    }

    $return_body['new_table'] = $inner_html;
    $return_body['id'] = $id;
    $return_body['success'] = true;
    $return_body['table_empty'] = $table_empty;
    echo json_encode($return_body);
?>