<?php
session_start();
if($_SESSION['mode']!=4)
$_SESSION['mode'] = 4;
else
$_SESSION['mode'] = 104;
$lokacja = $_SESSION['lokacja'];
header("Location: $lokacja");
?>