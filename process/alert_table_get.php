<?php 
echo '
    <table id="ViewAlertTable" class="table table-head-fixed text-nowrap table-hover">
        <thead>
            <tr style="border-bottom:1px solid black">
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>With Concern</th>
                <th>Contact Person</th>
                <th>Date Issued</th>
            </tr>
        </thead>
        <tbody id="AlertTableViewBody">';

$sql = "SELECT user_alerts.id_number, user_accounts.full_name, user_alerts.from_user, user_alerts.content, withconcern_masterlist.contact_person, user_alerts.date_created, user_alerts.dismissed
        FROM user_alerts
        LEFT JOIN user_accounts
        ON user_alerts.id_number = user_accounts.id_number
        LEFT JOIN withconcern_masterlist
        ON user_alerts.from_user = withconcern_masterlist.from_user
        ORDER BY user_alerts.date_created DESC LIMIT 50";
$stmt = $conn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
        echo '
        <tr onclick="alert_table_click.call(this)" style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#alert_table_click_modal" custom-content="' . htmlspecialchars($x["content"]) .  '">
            <td>' . $x["id_number"] . '</td>
            <td>' . $x["full_name"] . '</td>
            <td>' . $x["from_user"] . '</td>
            <td>' . $x["contact_person"] . '</td>
            <td>' . $x["date_created"] . '</td>
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
    <div class="form-inline text-muted" id="table-debug" style="display:none;">
        <div class="form-group">
            <p>---[Pagination Debug] &nbsp;</p>
        </div>
        <div class="form-group">
            <p>CurrentLoadedPagination=</p>
            <p id="CurrentLoadedPagination">' . $stmt->rowCount() . '</p><p>---&nbsp;</p>
        </div>
    </div>
    <p class="text-muted" id="AlertTableViewCount">Showing ' . $stmt->rowCount() .  ' results</p>
    ';
?>