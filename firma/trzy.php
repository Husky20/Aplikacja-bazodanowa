<?php
session_start();
if($_SESSION['mode']!=3)
$_SESSION['mode'] = 3;
else
$_SESSION['mode'] = 103;
$lokacja = $_SESSION['lokacja'];
header("Location: $lokacja");
?>