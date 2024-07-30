<?php
require 'conn.php';
session_name('exercise_1');
session_start();

//$employee_no = $_GET['employee_no'];
//$full_name = $_GET['full_name'];
$c = 0;

$delimiter = ","; 
$datenow = date('Y-m-d');
$filename = "Export Accounts 3 - ". $datenow.".csv";

// Create a file pointer 
$f = fopen('php://memory', 'w'); 

// UTF-8 BOM for special character compatibility
fputs($f, "\xEF\xBB\xBF");

// Set column headers 
$fields = array('#', 'ID Number', 'Full Name', 'Username', 'Password', 'Section', 'Position', 'Role'); 
fputcsv($f, $fields, $delimiter); 

$sql = "SELECT `id_number`, `full_name`, `username`, `password`, `section`, `position`, `role` FROM user_accounts";
$stmt = $conn -> prepare($sql);
$stmt -> execute();
$conn = null;
if ($stmt -> rowCount() > 0) {
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { 
        $c++;
        $lineData = array($c, $row['id_number'], $row['full_name'], $row['username'], $row['password'], $row['section'], $row['position'], $row['role']); 
        fputcsv($f, $lineData, $delimiter); 
    }
    
}
// Move back to beginning of file 
fseek($f, 0); 
// Set headers to download file rather than displayed 
header('Content-Type: text/csv'); 
header('Content-Disposition: attachment; filename="' . $filename . '";'); 
//output all remaining data on a file pointer 
fpassthru($f); 
?>