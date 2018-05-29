<?php
session_start();
require_once('dbconfig.php');
$sql="SELECT COUNT(*) as count FROM schedule_requests WHERE sch_status='New'";
$res=$mysqli->query($sql);
$row=$res->fetch_assoc();
echo $row['count'];
?>