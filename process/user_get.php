<?php 
//prepare the query
$id_number = $_SESSION['id_number'];
$username = $_SESSION['username'];
$sql = "SELECT * FROM user_accounts WHERE id_number = ? AND username = ? ";
$stmt = $conn->prepare($sql);
$params = array($id_number, $username);
$stmt->execute($params);
if ($stmt->rowCount() > 0) {
    foreach($stmt->fetchAll() as $x) {
    echo '
        <p><b>Full Name : </b>' . $x['full_name'] .  '</p>
        <p><b>ID Number : </b>' . $x['id_number'] .  '</p>
        <p><b>Section : </b>' . $x['section'] .  '</p>
        <p><b>Position : </b>' . $x['position'] .  '</p>
        <p><b>System Username : </b>' . $x['username'] .  '</p>
        <p><b>System Role : </b>' . $x['role'] .  '</p>
        <p><b>System Registration Date : </b>' . $x['date_created'] .  '</p>
    ';
    }
}else{
    ;
}

?>