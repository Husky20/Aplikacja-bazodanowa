<!--FIRMA-->
<?php
	session_start();
	if((isset($_SESSION['zalogowany']))&& ($_SESSION['zalogowany']==true)){
		header('Location: zadania.php');
		exit();		
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	<style>
	body
{
	background-color: #303030;
	color: #e28525;
	font-family: 'Lato', sans-serif;
	font-size: 15px;
}
#container
{
	width: 1000px;	
	margin-left: auto;
	margin-right: auto;
	align: center;
	text-align: center;
}
.rectangle
{
	width: 1000px;
	margin: 20px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
}
.rectangle1
{
	margin: 30px;
	text-align: center;

}
.square
{
	margin-left: auto;
	margin-right: auto;
	width: 900px;

	text-align: center;
	width: 50%;

}

#logo
{
	float: left;
	font-family: 'Josefin Sans', sans-serif;
	font-size: 70px;
	width: 600px;
	text-align: left;
}

#zegar
{
	float: left;
	font-family: 'Josefin Sans', sans-serif;
	font-size: 70px;
	text-align: left;
}
.logowanie
{
	margin-left: auto;
	margin-right: auto;
	align: center;
	margin-top: 50px;
	width: 500px;
	height: 150px;
	background-color: #666666;
	text-align: justify;
	padding: 30px;
}

.button2 {
 background-color: #414141; 
  border: none;
  color: #e28525;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  width: 200px;
  margin-right: -20px;
  margin-top: -80px;
  float: right;
}

.button:hover, .button1:hover, .button2:hover {
	background-color: #555555;
}
.przycisk:hover
{
	background-color: #c84222;
}
	</style>
	
	<meta charest="utf-8">
	<meta http-equiv = "X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Firma</title>
	<link href='http://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<script src="timer.js"></script>	
	
	 <script src="https://www.google.com/recaptcha/api.js"></script>
	
</head>

<body onload="odliczanie();">
<div id="container">	
		<div class="rectangle">
			<div id="logo">Aplikacja do zarządzania projektami</div>
			<div id="zegar">12:00:00</div>
			<div style="clear: both;"></div>
		</div>
		
	</div>
	<div class="square">
		<div class="logowanie">

	<form action="zaloguj.php" method = "post">
		Login: <br /> <input type = "text" name = "login" /><br />
		Hasło: <br /> <input type = "password" name = "haslo" /><br />
		<?php
			if(isset($_SESSION['blad'])){
				echo $_SESSION['blad'];	
				unset($_SESSION['blad']);
			}
		?>
		<br />
	
		<div class="g-recaptcha" data-sitekey="6Ld84sMUAAAAAFG2onMRjMJzUu2DG4-tJzzD6Q2E">
		</div>
		<?php
			if (isset($_SESSION['e_bot']))
			{
				echo $_SESSION['e_bot'];
				unset($_SESSION['e_bot']);
			}
		?>	
			<input type = "submit" class="button2" value = "Zaloguj się"/>
	</form>
	</div>
	</div>

<div class="rectangle1">2019 &copy; Żaneta Ciechowicz, Paweł Matyjek, Jakub Nowocień - Aplikacja bazodanowa do zarządzania projektami </div>
</body>
</html>