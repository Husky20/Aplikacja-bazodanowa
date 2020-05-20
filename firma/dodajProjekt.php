<?php

	session_start();
	if($_SESSION['uprawnienia']<2)
	{
		header('Location: index.php');
		exit();
	}
	if(!isset($_SESSION['uprawnienia']))
	{
		header('Location: index.php');
		exit();
	}
	if (isset($_POST['id']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$id = $_POST['id'];
		
		//Sprawdzenie długości nicka
		if (ctype_digit($id)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_id']="I musi byc liczba";
		}
		$nazwa = $_POST['nazwa'];
		if (strlen($nazwa)<3)
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwa']="Nazwa musi zawierac co namniej 3 litery";
		}
		//Sprawdź poprawność hasła
		$p_DataZ = $_POST['p_DataZ'];
		$adres = $_POST['adres'];
		$_SESSION['fr_id'] = $id;
		$_SESSION['fr_nazwa'] = $nazwa;
		$_SESSION['fr_p_DataZ'] = $p_DataZ;
		$_SESSION['fr_adres'] = $adres;
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try 
		{
			$polaczenie = mysqli_connect($host, $user, $password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Czy email już istnieje?
				$rezultat = $polaczenie->query("SELECT id FROM pracownicy WHERE PESEL='$PESEL'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				$ile_takich_nickow = $rezultat->num_rows;

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM pracownicy WHERE PESEL='$login'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					$zapytanie = "INSERT INTO projekty VALUES (NULL, $id, '$nazwa', now(), NULL,$p_DataZ, '$adres')";
					$rezultat = mysqli_query($polaczenie, $zapytanie);
						header('Location: projekty.php');
				}
				$polaczenie->close();
			}
			
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
		
	}
	
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta http-equiv="refresh" content = "3600; url=logout.php">
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<style>
		.error
		{
			color:red;
			margin-top: 10px;
			margin-bottom: 10px;			
			margin: 15px;
			
		}
body
{
	background-color: #303030;
	color: #e28525;
	font-family: 'Lato', sans-serif;
	font-size: 15px;
	align: center;
	
	
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
	margin: 20px;
  align: center;
  
}

.rectangle
{
	
	align:center;
	weight: 700;
	margin-left:300px;
	margin: 20px;
	text-align: center;
}

.rectangle1
{
	text-align: center;
	align:center;

}
.rectangle2
{
	text-align: center;

}

.tab
{	
	background-color: #555555;
	align:center;
	text-align: left;	
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
	</style>
</head>

<body>
<div align="center">
		<img src="Baaner/baner12.png" alt="Tekst alternatywny" width="950" height="150">
	</div>

<div class= "rectangle1">
	<?php
	echo "<form action='projekty.php' method = 'post'>
		<input type = 'submit' class='button' value = 'Projekty'/>
		</form>";
	if( $_SESSION['uprawnienia']==2)
		echo "<form action='wszystkieProjekty.php' method = 'post'>
		<input type = 'submit' class='button' value = 'Wszystkie Projekty'/>
		</form>";
		
?>
</div>

	<form method="post">
	<div class= "rectangle">		
		<table align="center" >
		<tr>
		
			<td align="left">ID Kierownika</td><td><input type="text" value="<?php
				if (isset($_SESSION['fr_id']))
				{
					echo $_SESSION['fr_id'];
					unset($_SESSION['fr_id']);
				}
				?>" name="ID" /><br /></td>
			<td align="left"><?php
				if (isset($_SESSION['e_id']))
				{
					echo '<div class="error">'.$_SESSION['e_id'].'</div>';
					unset($_SESSION['e_id']);
				}
				?>
			</td>
		</tr>
		<tr>
			<td align="left">Nazwa:</td><td><input type="text" value="<?php
				if (isset($_SESSION['fr_nazwa']))
				{
					echo $_SESSION['fr_nazwa'];
					unset($_SESSION['fr_nazwa']);
				}
			?>" name="nazwa" /><br /></td>
			
			<td align="left"><?php
				if (isset($_SESSION['e_nazwa']))
				{
					echo '<div class="error">'.$_SESSION['e_nazwa'].'</div>';
					unset($_SESSION['e_nazwa']);
				}
			?></td>
		</tr>
		<tr>
			<td align="left">Planowana Data Zakonczenia:</td><td>  <input type="text" value="<?php
				if (isset($_SESSION['fr_p_DataZ']))
				{
					echo $_SESSION['fr_p_DataZ'];
					unset($_SESSION['fr_p_DataZ']);
				}
			?>" name="p_DataZ" /><br /></td>
			<td align="left"> <?php
				if (isset($_SESSION['e_p_DataZ']))
				{
					echo '<div class="error">'.$_SESSION['e_p_DataZ'].'</div>';
					unset($_SESSION['e_p_DataZ']);
				}
			?></td>	
		</tr>
		<tr>
			<td align="left">Adres zgodnosci tresci:</td><td>  <input type="text" value="<?php
				if (isset($_SESSION['fr_adres']))
				{
					echo $_SESSION['fr_adres'];
					unset($_SESSION['fr_adres']);
				}
			?>" name="adres" /><br /></td>
			<td align="left"><?php
				if (isset($_SESSION['e_adres']))
				{
					echo '<div class="error">'.$_SESSION['e_adres'].'</div>';
					unset($_SESSION['e_adres']);
				}
			?>	</td>
		</tr>
		</table>
		</div>	
	<div class= "rectangle2">		
		<input type="submit" class="button2" value="Dodaj Projekt" />
	</div>	

</form>

</body>
</html>