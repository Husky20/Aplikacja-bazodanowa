<?php 

	session_start();
	if((!isset($_POST['login'])) || (!isset($_POST['haslo']))){
		header('Location: index.php');
		exit();
	}
	

  // proba otwarcie pliku access.log lub - w przypadku gdy zrodlowy nie istnieje - utworzenia go 
  $file = @fopen('access.log', 'a');
  @flock($file, 2); // blokowanie pliku - wylacznosc na zapis i odczyt

  $string = '%remote_ip% ( %forwarded_for% ), ID: %host% - [%time%], LOGIN: %login%'; // z konfiguracji odczytanie formatu zapisu logu
	
  $string = str_replace('%remote_ip%', getenv('REMOTE_ADDR'), $string);
  $string = str_replace('%host%', gethostbyaddr(getenv('REMOTE_ADDR')), $string);
  $string = str_replace('%forwarded_for%', getenv('HTTP_X_FORWARDED_FOR'), $string);
  $string = str_replace('%time%', date('d-m-Y H:i:s'), $string);
  $string = str_replace('%url%', getenv('REQUEST_URI'), $string);
  $string = str_replace('%user_agent%', getenv('HTTP_USER_AGENT'), $string);
  $string = str_replace('%login%', $_POST['login'], $string);

/* poczwszy od wersji 4.0.1 funkcja str_replace() moze przybierac wartosci ktore sa tablica */

  @fwrite($file, $string . "\n"); // zapisanie linii
  @flock($file, 3); // odblokowanie pliku
  @fclose($file);

// $Id: log.php,v 1.1 2003/07/28 11:12:09 Adam Exp $
	
	require_once"connect.php";
	
	$polaczenie = @new mysqli($host, $user, $password, $database);//dodac @ przed new
	if($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		
		$sekret = "6Ld84sMUAAAAALEmf3ppaWFSTEBvfrwG1HmQHb80";
		
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if ($odpowiedz->success==false){
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdź, że nie jesteś botem!";
			header('Location: index.php');
		}	
		else{
		
			
			
			$login = $_POST['login'];
			$haslo = $_POST['haslo'];
			
			
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");//zabespieczenia przed wstrzykiwaniem html
			//$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
			//$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
			//echo $haslo_hash;exit();
			if($rezultat = @$polaczenie->query(
			sprintf("SELECT * FROM pracownicy WHERE login = '%s'", mysqli_real_escape_string($polaczenie,$login))))
			{
				$ilu_userow = $rezultat->num_rows;
				if($ilu_userow>0){
					$wiersz = $rezultat->fetch_assoc();
					if(password_verify($haslo, $wiersz['haslo'])){
						
						$_SESSION['zalogowany']=true;
						
						$_SESSION['login'] = $login;
						$_SESSION['id'] = $wiersz['id'];
						$_SESSION['imie'] = $wiersz['imie'];
						$_SESSION['nazwisko'] = $wiersz['nazwisko'];
						$_SESSION['uprawnienia'] = $wiersz['uprawnienia'];
						
						
						unset($_SESSION['blad']);
						$rezultat->free_result();
						header('Location: zadania.php');
					}
					else{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					
					header('Location: index.php');
					}
				}else{
					$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
					
					header('Location: index.php');
				}
			}
			
			$polaczenie->close();
		}
	}
?>	