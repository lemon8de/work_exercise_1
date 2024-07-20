<?php 
echo "<script src='../../plugins/jquery/dist/jquery.min.js'></script>";
echo "<script src='../../plugins/datatables/datatables.js'></script>";
echo '
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>With Concern</th>
                <th>Date Issued</th>
                <th>Dismissed</th>
            </tr>
        </thead>
        <tbody>';

$sql = "SELECT id_number, from_user, date_created, dismissed FROM user_alerts";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
        $boolean = $x['dismissed'] == 1 ? "True" : "False";
        echo "
        <tr>
            <td>" . $x['id_number'] . "</td>
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