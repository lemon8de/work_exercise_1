<?php 
echo "<script src='../../plugins/jquery/dist/jquery.min.js'></script>";
echo "<script src='../../plugins/datatables/datatables.js'></script>";
echo '
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>With Concern</th>
                <th>Date Issued</th>
                <th>Dismissed</th>
            </tr>
        </thead>
        <tbody>';

$sql = "SELECT user_alerts.id_number, user_accounts.full_name, user_alerts.from_user, user_alerts.date_created, user_alerts.dismissed
        FROM user_alerts
        LEFT JOIN user_accounts
        ON user_alerts.id_number = user_accounts.id_number";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
        $boolean = $x['dismissed'] == 1 ? "True" : "False";
        echo "
        <tr>
            <td>" . $x['id_number'] . "</td>
            <td>" . $x['full_name'] . "</td>
            <td>" . $x['from_user'] . "</td>
            <td>" . $x['date_created'] . "</td>
            <td>" . $boolean . "</td>
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
        echo "<script>table = new DataTable('#example');</script>";
?>