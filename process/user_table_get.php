<?php 
echo '
    <table id="UserAlertTable" class="table table-head-fixed text-nowrap table-hover">
        <thead>
            <tr style="border-bottom:1px solid black">
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Username</th>
                <th>Section</th>
                <th>Position</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody id="UserTableViewBody">';

$sql = "SELECT id, id_number, full_name, username, section, position, role FROM user_accounts";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
        echo '
        <tr onclick="usertable_click.call(this)" id="' . $x['id'] .  '">
            <td>' . $x["id_number"] . '</td>
            <td>' . $x["full_name"] . '</td>
            <td>' . $x["username"] . '</td>
            <td>' . $x["section"] . '</td>
            <td>' . $x["position"] . '</td>
            <td>' . $x["role"] . '</td>
        </tr>
        ';
    }
    
}else{
    ;
}
    echo '
        </tbody>
    </table>
    </div>
    ';
?>