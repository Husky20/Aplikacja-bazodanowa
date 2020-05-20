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
	if (isset($_POST['imie']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność nickname'a
		$imie = $_POST['imie'];
		
		//Sprawdzenie długości nicka
		if ((strlen($imie)<3) || (strlen($imie)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_imie']="Imie musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alpha($imie)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_imie']="Imie może składać się tylko z liter";
		}
		$nazwisko = $_POST['nazwisko'];
		if ((strlen($nazwisko)<3) || (strlen($nazwisko)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwisko']="Nazwisko musi posiadać od 3 do 20 znaków!";
		}
		
		if (ctype_alpha($nazwisko)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nazwisko']="Nazwisko może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		
		//Sprawdź poprawność hasła
		$PESEL = $_POST['PESEL'];
		if ((strlen($PESEL)!=11))
		{
			$wszystko_OK=false;
			$_SESSION['e_PESEL']="PESEL musi mieć 11 znaków";
		}
		if(ctype_digit($PESEL)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_PESEL']="PESEL może składać się tylko z cyfr";
		}
		$login = $_POST['login'];
		if ((strlen($login)<3) || (strlen($login)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="Login musi posiadać od 3 do 20 znaków!";
		}
		
		if(ctype_alnum($login)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_login']="login może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		$haslo = $_POST['haslo'];
		if (ctype_alnum($haslo)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Haslo może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		if ((strlen($haslo)<3) || (strlen($haslo)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="haslo musi posiadać od 3 do 20 znaków!";
		}
		
		
		$nr_dowodu = $_POST['nr_dowodu'];
		if ((strlen($nr_dowodu)!=6))
		{
			$wszystko_OK=false;
			$_SESSION['e_nr_dowodu']="nr dowodu musi mieć 6 znaków";
		}
		
		if (ctype_alnum($nr_dowodu)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nr_dowodu']="nr_dowodu może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
		
		$telefon = $_POST['telefon'];
		if ((strlen($telefon)!=9))
		{
			$wszystko_OK=false;
			$_SESSION['e_telefon']="telefon musi miec 9 znaków";
		}
		
		if (ctype_digit($telefon)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_telefon']="telefon może składać się tylko z cyfr";
		}
		$uprawnienia = $_POST['uprawnienia'];
		if ((strlen($uprawnienia)!=1))
		{
			$wszystko_OK=false;
			$_SESSION['e_uprawnienia']="uprawnienia od 0-3!";
		}
		
		if (ctype_digit($uprawnienia)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_uprawnienia']="uprawnienia od 0-3";
		}
		
		//Czy zaakceptowano regulamin?			
		
		//Bot or not? Oto jest pytanie!
		$sekret = "PODAJ WŁASNY SEKRET!";
		
		
		
		//Zapamiętaj wprowadzone dane
		$_SESSION['fr_imie'] = $imie;
		$_SESSION['fr_nazwisko'] = $nazwisko;
		$_SESSION['fr_PESEL'] = $PESEL;
		$_SESSION['fr_nr_dowodu'] = $nr_dowodu;
		$_SESSION['fr_login'] = $login;
		$_SESSION['fr_haslo'] = $haslo;
		$_SESSION['fr_telefon'] = $telefon;
		$_SESSION['fr_uprawnienia'] = $uprawnienia;
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
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_PESEL']="Istnieje już pracownik o takim nr PESEL";
				}

				//Czy nick jest już zarezerwowany?
				$rezultat = $polaczenie->query("SELECT id FROM pracownicy WHERE PESEL='$login'");
				
				if (!$rezultat) throw new Exception($polaczenie->error);
				
				$ile_takich_nickow = $rezultat->num_rows;
				if($ile_takich_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['e_login']="Istnieje już pracownik o takim loginie";
				}
				
				if ($wszystko_OK==true)
				{
					//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					$zapytanie = "INSERT INTO pracownicy VALUES (NULL, '$imie', '$nazwisko', $PESEL, '$nr_dowodu', now(), NULL, '$login','$haslo',$telefon,$uprawnienia)";
					$rezultat = mysqli_query($polaczenie, $zapytanie);
						header('Location: pracownicy.php');
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
	echo "<form action='pracownicy.php' method = 'post'>
		<input type = 'submit' class='button' value = 'Pracownicy'/>
		</form>";
?>
</div>

	<form method="post">
	<div class= "rectangle">		
		<table align="center" >
		<tr>
		
			<td align="left">Imię:</td><td><input type="text" value="<?php
				if (isset($_SESSION['fr_imie']))
				{
					echo $_SESSION['fr_imie'];
					unset($_SESSION['fr_imie']);
				}
				?>" name="imie" /><br /></td>
			<td align="left"><?php
				if (isset($_SESSION['e_imie']))
				{
					echo '<div class="error">'.$_SESSION['e_imie'].'</div>';
					unset($_SESSION['e_imie']);
				}
				?>
			</td>
		</tr>
		<tr>
			<td align="left">Nazwisko:</td><td><input type="text" value="<?php
				if (isset($_SESSION['fr_nazwisko']))
				{
					echo $_SESSION['fr_nazwisko'];
					unset($_SESSION['fr_nazwisko']);
				}
			?>" name="nazwisko" /><br /></td>
			
			<td align="left"><?php
				if (isset($_SESSION['e_nazwisko']))
				{
					echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div>';
					unset($_SESSION['e_nazwisko']);
				}
			?></td>
		</tr>
		<tr>
			<td align="left">PESEL:</td><td> <input type="text"  value="<?php
				if (isset($_SESSION['fr_PESEL']))
				{
					echo $_SESSION['fr_PESEL'];
					unset($_SESSION['fr_PESEL']);
				}
			?>" name="PESEL" /><br /></td>
			
			<td align="left"><?php
				if (isset($_SESSION['e_PESEL']))
				{
					echo '<div class="error">'.$_SESSION['e_PESEL'].'</div>';
					unset($_SESSION['e_PESEL']);
				}
			?></td>		
		</tr>
		<tr>
			<td align="left">Numer dowodu:</td><td>  <input type="text" value="<?php
				if (isset($_SESSION['fr_nr_dowodu']))
				{
					echo $_SESSION['fr_nr_dowodu'];
					unset($_SESSION['fr_nr_dowodu']);
				}
			?>" name="nr_dowodu" /><br /></td>
			<td align="left"> <?php
				if (isset($_SESSION['e_nr_dowodu']))
				{
					echo '<div class="error">'.$_SESSION['e_nr_dowodu'].'</div>';
					unset($_SESSION['e_nr_dowodu']);
				}
			?></td>	
		</tr>
		<tr>
			<td align="left">Login:</td><td>  <input type="text" value="<?php
				if (isset($_SESSION['fr_login']))
				{
					echo $_SESSION['fr_login'];
					unset($_SESSION['fr_login']);
				}
			?>" name="login" /><br /></td>
			<td align="left"><?php
				if (isset($_SESSION['e_login']))
				{
					echo '<div class="error">'.$_SESSION['e_login'].'</div>';
					unset($_SESSION['e_login']);
				}
			?>	</td>
		</tr>
		<tr>
			<td align="left">Hasło:</td><td>  <input type="text" value="<?php
				if (isset($_SESSION['fr_haslo']))
				{
					echo $_SESSION['fr_haslo'];
					unset($_SESSION['fr_haslo']);
				}
			?>" name="haslo" /><br /></td>
			<td align="left"><?php
				if (isset($_SESSION['e_haslo']))
				{
					echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
					unset($_SESSION['e_haslo']);
				}
			?></td>
		</tr>
		<tr>
			<td align="left">Telefon:</td><td>  <input type="text" value="<?php
				if (isset($_SESSION['fr_telefon']))
				{
					echo $_SESSION['fr_telefon'];
					unset($_SESSION['fr_telefon']);
				}
			?>" name="telefon" /><br /></td>
			<td align="left"><?php
				if (isset($_SESSION['e_telefon']))
				{
					echo '<div class="error">'.$_SESSION['e_telefon'].'</div>';
					unset($_SESSION['e_telefon']);
				}
			?></td>	
		</tr>
		<tr>
			<td align="left">Uprawnienia:</td><td align="left">  <select name="uprawnienia">
        <option>0</option>
        <option>1</option>
        <option>2</option>
      </select><br /></td>
			<td align="left"><?php
				if (isset($_SESSION['e_uprawnienia']))
				{
					echo '<div class="error">'.$_SESSION['e_uprawnienia'].'</div>';
					unset($_SESSION['e_uprawnienia']);
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