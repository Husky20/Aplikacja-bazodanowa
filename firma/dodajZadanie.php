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
		
		if (ctype_digit($id)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_id']="id to liczby ;)";
		}
		$nazwa = $_POST['nazwa'];
		if ((strlen($nazwa)<3) || (strlen($nazwa)>200))
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwa']="Nazwa musi posiadac 3 znaki i byc mniejsza niz 200";
		}
		
		if (ctype_alpha($nazwa)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwa']="Nazwa może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		$opis = $_POST['opis'];
		if ((strlen($opis)<3) || (strlen($opis)>200))
		{
			$wszystko_OK=false;
			$_SESSION['e_opis']="opis musi posiadac 3 znaki i byc mniejsza niz 200";
		}
		
		if (ctype_alpha($opis)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_opis']="Opis może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		$czas = $_POST['czas'];
		
		if(ctype_digit($czas)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_czas']="podaj liczbe i bedziemy zadowoleni";
		}
		$_SESSION['fr_id'] = $id;
		$_SESSION['fr_nazwa'] = $nazwa;
		$_SESSION['fr_opis'] = $opis;
		$_SESSION['fr_czas'] = $czas;
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
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					$zapytanie = "INSERT INTO zadania VALUES (NULL, $id, '$nazwa', '$opis', 'nierozpoczete', now(), NULL,$czas)";
					$rezultat = mysqli_query($polaczenie, $zapytanie);
						header('Location: zadania.php');
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
	echo "<form action='zadania.php' method = 'post'>
		<input type = 'submit' class='button' value = 'Zadania'/>
		</form>";
		if( $_SESSION['uprawnienia']==2)
			echo "<form action='WszystkieZadania.php' method = 'post'>
		<input type = 'submit' class='button' value = 'Wszystkie Zadania'/>
		</form>";
?>
</div>

	<form method="post">
	<div class= "rectangle">		
		<table align="center" >
		<tr>
		
			<td align="left">ID projektu:</td><td><input type="text" value="<?php
				if (isset($_SESSION['fr_id']))
				{
					echo $_SESSION['fr_id'];
					unset($_SESSION['fr_id']);
				}
				?>" name="id" /><br /></td>
				
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
			<td align="left">Nazwa Zadania:</td><td><input type="text" value="<?php
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
			<td align="left">Opis:</td><td> <input type="text"  value="<?php
				if (isset($_SESSION['fr_opis']))
				{
					echo $_SESSION['fr_opis'];
					unset($_SESSION['fr_opis']);
				}
			?>" name="opis" /><br /></td>
			
			<td align="left"><?php
				if (isset($_SESSION['e_opis']))
				{
					echo '<div class="error">'.$_SESSION['e_opis'].'</div>';
					unset($_SESSION['e_opis']);
				}
			?></td>		
		</tr>
		<tr>
			<td align="left">Przewidywany czas w roboczogodzinach:</td><td>  <input type="text" value="<?php
				if (isset($_SESSION['fr_czas']))
				{
					echo $_SESSION['fr_czas'];
					unset($_SESSION['fr_czas']);
				}
			?>" name="czas" /><br /></td>
			<td align="left"> <?php
				if (isset($_SESSION['e_czas']))
				{
					echo '<div class="error">'.$_SESSION['e_czas'].'</div>';
					unset($_SESSION['e_nr_czas']);
				}
			?></td>	
		</tr>
		</table>
		</div>	
	<div class= "rectangle2">		
		<input type="submit" class="button2" value="Dodaj pracownika" />
	</div>	

</form>

</body>
</html>