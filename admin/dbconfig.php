<?php
//Open a new connection to the MySQL server
$mysqli = new mysqli('localhost','selfpt47_dev17','dev17','selfpt47_dev17');

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

?>