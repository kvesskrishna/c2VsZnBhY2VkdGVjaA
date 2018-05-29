  <?php
$from=$_POST['start'];
$end=$_POST['end'];
require_once('dbconfig.php');
$sql = "SELECT en_course,en_name,en_email,en_countrycode, en_timezone,en_phone,en_notes,en_status,en_createdon FROM enroll_requests WHERE en_createdon>='$from' AND en_createdon<='$end'";
//echo $sql;

$setRec = $mysqli->query($sql);
$columnHeader = '';
$columnHeader = "Course" . "\t" . "Name" . "\t" . "Email" . "\t" . "Country code" . "\t". "Timezone" . "\t". "Phone" . "\t". "Notes" . "\t". "Status" . "\t". "Request Date" . "\t";
$setData = '';
while ($rec = mysqli_fetch_row($setRec)) {
$rowData = '';
foreach ($rec as $value) {
$value = '"' . $value . '"' . "\t";
$rowData .= $value;
}
$setData .= trim($rowData) . "\n";
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=enrollments_details.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
 
    ?>