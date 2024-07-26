<?php 
echo '
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr style="border-bottom:1px solid black">
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>With Concern</th>
                <th>Contact Person</th>
                <th>Date Issued</th>
            </tr>
        </thead>
        <tbody>';

$sql = "SELECT user_alerts.id_number, user_accounts.full_name, user_alerts.from_user, withconcern_masterlist.contact_person, user_alerts.date_created, user_alerts.dismissed
        FROM user_alerts
        LEFT JOIN user_accounts
        ON user_alerts.id_number = user_accounts.id_number
        LEFT JOIN withconcern_masterlist
        ON user_alerts.from_user = withconcern_masterlist.from_user";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
        echo "
        <tr>
            <td>" . $x['id_number'] . "</td>
            <td>" . $x['full_name'] . "</td>
            <td>" . $x['from_user'] . "</td>
            <td>" . $x['contact_person'] . "</td>
            <td>" . $x['date_created'] . "</td>
        </tr>
        ";
    }
    
}else{
    ;
}
    echo '
        </tbody>
    </table>
    ';
?>