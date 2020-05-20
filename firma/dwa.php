<?php
session_start();
if($_SESSION['mode']!=2)
$_SESSION['mode'] = 2;
else
$_SESSION['mode'] = 102;
$lokacja = $_SESSION['lokacja'];
header("Location: $lokacja");
?>