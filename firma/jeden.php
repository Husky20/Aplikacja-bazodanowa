<?php
session_start();
if($_SESSION['mode']!=1)
	$_SESSION['mode'] = 1;
else
	$_SESSION['mode'] = 101;
$lokacja = $_SESSION['lokacja'];
header("Location: $lokacja");
?>