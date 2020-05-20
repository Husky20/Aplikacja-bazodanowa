<?php
session_start();
if($_SESSION['mode']!=6)
$_SESSION['mode'] = 6;
else
$_SESSION['mode'] = 106;
$lokacja = $_SESSION['lokacja'];
header("Location: $lokacja");
?>