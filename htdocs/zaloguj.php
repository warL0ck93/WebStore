<?php
	
	header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");

    if((!isset($_POST['login'])) || (!isset($_POST['password'])))
    {
        header("Location: loginscreen.php");
        exit();
    }

	require 'database.php';

	$connection = @new mysqli($host, $db_user, $db_password, $db_name);

	if($connection->connect_errno!=0)
	{
		echo "Error:".$connection->connect_errno;
	}
	else
	{
		$login = $_POST['login'];
		$password = $_POST['password'];
        
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $password = htmlentities($password, ENT_QUOTES, "UTF-8");
        echo "jestem tutaj";
		if($log_res = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s'", mysqli_real_escape_string($connection,$login))))
		{
			$how_many = $log_res->num_rows;
			
			echo "Znaleziono dopasowań: ".$log_res->num_rows;

			$Ipcheck = @$connection->query(sprintf("SELECT * FROM Login_history WHERE ip = '%s' AND login = '%s' AND TIMESTAMPDIFF(MINUTE, Login_history.data, NOW()) < 5",mysqli_real_escape_string($connection,$_SERVER[REMOTE_ADDR]),mysqli_real_escape_string($connection,$login) ))
			or die("KUPA");
			$check_lock = $Ipcheck->num_rows;
			setcookie('numlog',$check_lock,time()+3600);
			if ($check_lock>=5) 
			{
				echo "nie zadzialalo";
				setcookie('blad','Zbyt dużo nieudanych prób logowania na to konto proszę spróbować później',time()+3600);
				header('Location: loginscreen.php');
			}
			if($how_many>0)
			{
				$r = $log_res->fetch_assoc();
				$sol = $r['sol'];
				$password = sha1(sha1($password.$sol).$sol);
				$password = htmlentities($password, ENT_QUOTES, "UTF-8");
				if($log_res = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s'  AND haslo = '%s'", mysqli_real_escape_string($connection,$login),mysqli_real_escape_string($connection,$password))))
				{
					$how_many = $log_res->num_rows;
			
					echo "Znaleziono dopasowań: ".$log_res->num_rows;

					if($how_many>0&&$check_lock<5)
					{


						$wiersz = $log_res->fetch_assoc();
						
						

						$id = uniqid();
						$login = $wiersz['nazwa_uzytkownika'];
						$ip = $_SERVER[REMOTE_ADDR];
						$token = uniqid();
						date_default_timezone_set('Europe/Berlin');
						$date = strftime("%F %T");
						@$connection->query(sprintf("DELETE FROM Sesja WHERE login='%s'", mysqli_real_escape_string($connection,$login)));
						@$connection->query(sprintf("INSERT INTO Sesja(id_sesji, login, adres_ip_sesji, token, godzina_zalogowania) VALUES ('%s', '%s', '%s', '%s','%s')", mysqli_real_escape_string($connection,$id),mysqli_real_escape_string($connection,$login),mysqli_real_escape_string($connection,$ip),mysqli_real_escape_string($connection,$token),mysqli_real_escape_string($connection,$date)));
						setcookie('login',$login,time()+3600, $secure = true);
						setcookie('id',$id,time()+3600,$secure = true);
                		setcookie('ip',$ip,time()+3600,$secure = true);
		                setcookie('token',$token,time()+3600,$secure = true);

						$log_res->close();
						header('Location: index.php');				
					}
					else
					{
						echo "nie zadzialalo";
						date_default_timezone_set('Europe/Berlin');
						$date = strftime("%F %T");
						$ip = $_SERVER[REMOTE_ADDR];
						$log_res = @$connection->query(sprintf("INSERT INTO Login_history (login, ip, data) VALUES ('%s','%s','%s')", mysqli_real_escape_string($connection,$login),mysqli_real_escape_string($connection,$ip),mysqli_real_escape_string($connection,$date)))
						or die("Błąd dowdawanie złego logowania");
						setcookie('blad','Nieprawidłowy login lub hasło!',time()+3600);
						header('Location: loginscreen.php');
					}
				}


			}
			else
			{
				echo "nie zadzialalo";
				setcookie('blad','Nieprawidłowy login lub hasło!',time()+3600);
				header('Location: loginscreen.php');
			}
		}
		else
		{
			echo "nie zadzialalo";
		}

		$connection->close();
	}

?>