<?php
	session_start();
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	require_once"connect.php";
	$_SESSION['lokacja'] = "pracownicy.php";
	if(isset($_SESSION['mode']))
		$mode = $_SESSION['mode'];
	else
		$mode = 1;
	$uprawnienia = $_SESSION['uprawnienia'];
	$id = $_SESSION['id'];
	ini_set("display_errors", 0);
            require_once "connect.php";
            $polaczenie = mysqli_connect($host, $user, $password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);
			
			
			if (isset($_POST['id1'])){
		$wszystko_OK=true;
		$id1 = $_POST['id1'];
		$id2 = $_POST['id2'];
		$rola = $_POST['rola'];
		if (ctype_digit($id1)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_id1']="cos tu poszlo nie tak z id";
		}
		if (ctype_digit($id2)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_id1']="cos tu poszlo nie tak z id";
		}
		if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					$zapytanie1 = "INSERT INTO zadania_pracownika VALUES (NULL, $id1, $id2,'$rola')";
					$rezultat = mysqli_query($polaczenie, $zapytanie1);
						header('Location: wszystkieZadania.php');
				}
	}
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
  margin: 10px;
  margin-left: 20px;
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
	background-color: #333333;
	width: 250px;
	color: white;
}

.rectangle
{
	width: 1000px;
	margin: 10px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	align: center;
}
.rectangle1
{
	width: 1200px;
	margin-top: 20px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	align: center;
}
.rectangle3
{
	width: 1800px;
	margin-top: 20px;
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
<body onload="odliczanie();">
<div id="container">
	<div align="center">
		<img src="Baaner/baner12.png" alt="Tekst alternatywny" width="950" height="150">
	</div>
	<div class="rectangle">
			<div id="logo"><a><?php echo $_SESSION['imie']." ".$_SESSION['nazwisko'];?> - Pracownicy</a></div>
			<div id="zegar">12:00:00</div>
			<form action="logout.php" method = "post">
					<input type = "submit" class="btn" value = "Wyloguj się"/>
				</form>
			<div style="clear: both;"></div>
				
	</div>
	<div class="rectangle1">
			<?php
			echo"
			
				<form action='zadania.php' method = 'post'>
				<input type = 'submit' class = 'button' value = 'Zadania'/>
				</form>
			";
			if( $_SESSION['uprawnienia']>=1){
			echo"
			<form action='projekty.php' method = 'post'>
			<input type = 'submit' class = 'button' value = 'Projekty'/>
			</form>";
			
			}
			
			if( $_SESSION['uprawnienia']==2){
			echo"
			<form action='wszystkieProjekty.php' method = 'post'>
			<input type = 'submit' class = 'button' value = 'Wszystkie Projekty'/>
			</form>";
			echo"
			<form action='wszystkieZadania.php' method = 'post'>
			<input type = 'submit' class = 'button' value = 'Wszystkie zadania'/>
			</form>";
			echo"
			<form action='dodajPracownika.php' method = 'post'>
			<input type = 'submit' class = 'button2' value = 'Dodaj Pracownika'/>
			</form>";
			}
			?>
			
			<div style="clear: both;">
			</div>
		</div>
		<div style="clear: both;">
			</div>
			<div class="tab">
<table width="1000" align="center" border="1"   bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
        <tr>
<?php
if($uprawnienia>=1){
//if ($ile>=1) 
//{	
echo<<<END
<td width="30" align="center" bgcolor="333333"><form action="jeden.php" method = "post"><input type = 'submit' class = 'button1' value = "id"/></form></td>
<td width="100" align="center" bgcolor="333333"><form action="dwa.php" method = "post"><input type = 'submit' class = 'button1' value = "Imię"/></form></td>
<td width="100" align="center" bgcolor="333333"><form action="trzy.php" method = "post"><input type = 'submit' class = 'button1'value = "Nazwisko"/></form></td>
<td width="100" align="center" bgcolor="333333"><form action="cztery.php" method = "post"><input type = 'submit' class = 'button1' value = "Data zatrudnienia"/></form></td>
<td width="100" align="center" bgcolor="333333">telefon</td>
<td width="100" align="center" bgcolor="333333"><form action="piec.php" method = "post"><input type = 'submit' class = 'button1' value = "stanowisko"/></form></td>
</tr><tr>
END;

if($mode == 1 || $mode == 101)
	$wg = 'id';
else if($mode == 2 || $mode == 102)
	$wg = 'imie';
else if($mode == 3 || $mode == 103)
	$wg = 'nazwisko';
else if($mode == 4 || $mode == 104)
	$wg = 'dataZatrudnienia';
else if($mode == 5 || $mode == 105)
	$wg = 'stanowisko';
if($mode < 100){
$zapytanietxt = "
SELECT 
*

FROM 
pracownicy

ORDER BY $wg";
}  
else{
$zapytanietxt = "
SELECT 
*

FROM 
pracownicy

ORDER BY $wg DESC";
}  
$rezultat = mysqli_query($polaczenie, $zapytanietxt);
$ile = mysqli_num_rows($rezultat);
//}
//else{
//	echo "nie znaleziono wyników<br />";
//}
for ($i = 1; $i <= $ile; $i++)
	{
	$row = mysqli_fetch_assoc($rezultat);
		$a1 = $row['id'];
		$a2 = $row['imie'];
		$a3 = $row['nazwisko'];
		$a4 = $row['dataZatrudnienia'];
		$a5 = $row['telefon'];
		$a6 = $row['stanowisko'];
echo<<<END
<td width="100" align="center">$a1</td>
<td width="100" align="center">$a2</td>
<td width="100" align="center">$a3</td>
<td width="100" align="center">$a4</td>
<td width="100" align="center">$a5</td>
<td width="100" align="center">$a6</td>
</tr><tr>
END;
}
}
else{
	echo "NIE MASZ UPRAWNIEN";
}
?>
</tr></table>
</div>
<div style="clear: both;"></div>
<div class="rectangle3">
	<table>
		<?php
				if($_SESSION['uprawnienia']>0){
					echo"<form method = 'post'>
					 Przydziel zadanie o id:<input type = 'text' name = 'id1' />do pracownika o id:
					<input type = 'text' name = 'id2' /> Rola pracownika:
					<input type = 'text' name = 'rola' />
						<input type = 'submit' class = 'button2' value = 'Przydziel'/>
						</form>
					";
				}
		?>
	</table>	
</div>
<div class="rectangle">2019 &copy; Żaneta Ciechowicz, Paweł Matyjek, Jakub Nowocień - Aplikacja bazodanowa do zarządzania projektami </div>
</div>
</body>
</html>