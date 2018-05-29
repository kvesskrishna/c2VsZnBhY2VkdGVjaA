  <?php
$from=$_POST['start'];
$end=$_POST['end'];
$status=$_POST['status'];

require_once('dbconfig.php');
if ($status=='all') {
	# code...
$sql = "SELECT technology, training_createdby, training_time, meeting_platform, meeting_id, trainer_name, trainer_email, trainer_phone, trainer_timezone, student_name, student_email, student_phone, student_timezone, student_country, consultancy_name, start_date, end_date, training_status, training_comments FROM trainings WHERE training_created>='$from' AND training_created<='$end' AND training_time='Day'";
}
else
$sql = "SELECT technology, training_createdby, training_time, meeting_platform, meeting_id, trainer_name, trainer_email, trainer_phone, trainer_timezone, student_name, student_email, student_phone, student_timezone, student_country, consultancy_name, start_date, end_date, training_status, training_comments FROM trainings WHERE training_created>='$from' AND training_created<='$end' AND training_status='".$status."' AND training_time='Day'";

//echo $sql;

$setRec = $mysqli->query($sql);
$columnHeader = '';
$columnHeader = "Technology" . "\t"."Created by". "\t"."Day/Night" . "\t"."Meeting Platform" . "\t" ."Meeting ID" . "\t" ."Trainer Name" . "\t" . "Trainer Email" . "\t" . "Trainer Phone" . "\t"."Trainer Timezone" . "\t". "Student Name " . "\t". "Student Email" . "\t". "Student Phone" . "\t"."Student Timezone" . "\t". "Student Country" . "\t". "Consultancy Name" . "\t"."Start Date" . "\t"."End date" . "\t"."Status" . "\t"."Comments" . "\t";
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
header("Content-Disposition: attachment; filename=day_training_details".$from.".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
 
    ?>