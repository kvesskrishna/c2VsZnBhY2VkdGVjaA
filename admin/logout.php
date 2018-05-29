<?php
session_start();
if (isset($_SESSION['user'])) {
	# code...
	session_unset();
	header('Location:home.php');
}
?>