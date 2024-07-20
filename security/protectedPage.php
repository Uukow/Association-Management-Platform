<?php
session_start();
if(!isset($_SESSION['username'])){
	header("Location: ../View/login.php");
	exit();
}
?>