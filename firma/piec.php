<?php
session_start();
if($_SESSION['mode']!=5)
$_SESSION['mode'] = 5;
else
$_SESSION['mode'] = 105;
$lokacja = $_SESSION['lokacja'];
header("Location: $lokacja");
?>