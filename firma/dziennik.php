<?php 

	session_start();
	if($_SESSION['uprawnienia']<2){
		header('Location: index.php');
		exit();
	}
	if(!isset($_SESSION['uprawnienia'])){
		header('Location: index.php');
		exit();
	}
	 $file = @fopen('access.log', 'a');
  @flock($file, 2); // blokowanie pliku - wylacznosc na zapis i odczyt

  $string = 'Sprawdzenie dziennkika: %remote_ip% ( %forwarded_for% ), ID: %host% - [%time%], LOGIN: %login%'; // z konfiguracji odczytanie formatu zapisu logu
	
  $string = str_replace('%remote_ip%', getenv('REMOTE_ADDR'), $string);
  $string = str_replace('%host%', gethostbyaddr(getenv('REMOTE_ADDR')), $string);
  $string = str_replace('%forwarded_for%', getenv('HTTP_X_FORWARDED_FOR'), $string);
  $string = str_replace('%time%', date('d-m-Y H:i:s'), $string);
  $string = str_replace('%url%', getenv('REQUEST_URI'), $string);
  $string = str_replace('%user_agent%', getenv('HTTP_USER_AGENT'), $string);
  $string = str_replace('%login%', $_SESSION['login'], $string);

/* poczwszy od wersji 4.0.1 funkcja str_replace() moze przybierac wartosci ktore sa tablica */

  @fwrite($file, $string . "\n"); // zapisanie linii
  @flock($file, 3); // odblokowanie pliku
  @fclose($file);
$plik = fopen('access.log','r');

$zawartosc = '';

// przypisanie zawartości do zmiennej
while(!feof($plik))
{
   $linia = fgetc($plik);
	if($linia == "\n")
		$zawartosc.="</br>";
	else
		$zawartosc .= $linia;
}
echo $_SESSION['login'];
echo $zawartosc;
@fclose($plik);
echo"<form action='zadania.php' method = 'post'>
			<input type = 'submit' class = 'button2' value = 'Zadania'/>
			</form>";
	
?>	
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta http-equiv="refresh" content = "3600; url=logout.php">
	<meta charest="utf-8">
	<meta http-equiv = "X-UA-Compatible" content="IE=edge,chrome=1"/>
		<link rel="stylesheet" href="css/fontello.css" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<title>Zadania</title>
	 <style>
body{
	background-color: #303030;
	color: #e28525;
	font-family: 'Lato', sans-serif;
	font-size: 15px;
}

.button {
 background-color: #666666; 
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  width: 200px;
  float: left;
  margin-left: 20px;
  margin: 10px;
 
}

.button:hover, .button1:hover, .button2:hover {
	background-color: #555555;
}

.button1 {
 background-color: #414141;
  border: none;
  color: #e28525;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  
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
  margin: 10px;
}

#container{
	margin-left: auto;
	margin-right: auto;
	text-align: center;
}

#nav
{
	float: left;
	background-color: #666666;
	width: 250px;
	color: white;
}

.rectangle
{
	width: 1000px;
	margin: 15px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	align: center;
}
.rectangle1
{
	width: 1200px;
	margin-top: 10px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	align: center;
}
.square
{
	margin-left: auto;
	margin-right: auto;
	width: 1000px;
	text-align: center;
	width: 50%;
	margin-top: 20px;

}

#logo
{
	float: left;
	font-family: 'Josefin Sans', sans-serif;
	font-size: 40px;
	width: 600px;
	text-align: left;
}

#zegar
{
	float: left;
	font-family: 'Josefin Sans', sans-serif;
	font-size: 40px;
	text-align: left;
	width: 200px;
}

.tab{
	margin-top: 50px;
	width: auto;
	height: auto;
	background-color: #414141;
	align: center;

}

.btn
{
	background-color: #e28525;
	color: white;
}


	</style>

	<script src="timer.js"></script>	
</head>