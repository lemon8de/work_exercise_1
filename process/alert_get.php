<?php 
//prepare the query
$id_number = $_SESSION['id_number'];
$sql = "SELECT * FROM user_alerts WHERE id_number = ? AND dismissed = '0'";
$stmt = $conn->prepare($sql);
$params = array($id_number);
$stmt->execute($params);
if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
    echo '
        <div class="col-sm-12">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i>' 
    . $x['from_user'] . '</h5>'
    // main content is here
    . $x['content']
    . '</div>' . '</div>';
    }
}else{
    ;
}

?>