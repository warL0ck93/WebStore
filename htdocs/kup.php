<?php
header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");
	
	if(!isset($_COOKIE['buyprocedure']))
    {
        header('Location: index.php');
    }
    else
    {
    	if($_COOKIE['buyprocedure']==$_GET['id'])
    	{
    		setcookie("buyprocedure",null,time()-1);
        	unset($_COOKIE['buyprocedure']);
    	}
        else
        {
        	setcookie("buyprocedure",null,time()-1);
        	unset($_COOKIE['buyprocedure']);
        	header('Location: index.php');
        }
    }
	if(!isset($_COOKIE['id']))
    {
        header("Location: index.php");
        exit();
    }
    require 'database.php';
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    $log_res = @$connection->query(sprintf("SELECT * FROM Sesja WHERE login='%s' ", mysqli_real_escape_string($connection,$_COOKIE['login'])));
    $wiersz = $log_res->fetch_assoc();

    $check = $wiersz['token'];
    if($check == mysqli_real_escape_string($connection,$_COOKIE['token']))
    {
        $token = uniqid();
        
        @$connection->query(sprintf("UPDATE Sesja SET token='%s' WHERE login='%s'", mysqli_real_escape_string($connection,$token),mysqli_real_escape_string($connection,$_COOKIE['login'])));
        setcookie('token',$token,time()+3600);
        setcookie('blad','zgadzalysie',time()+3600);
    }
    else
    {
        setcookie('blad',$check,time()+3600);
        setcookie('blad2',mysqli_real_escape_string($connection,$_COOKIE['token']),time()+3600);
        @$connection->query(sprintf("DELETE FROM Sesja WHERE login='%s'", mysqli_real_escape_string($connection,$_COOKIE['login'])));
    setcookie("id",0,time()-1);
    unset($_COOKIE['id']);

    setcookie("login",0,time()-1);
    unset($_COOKIE['login']);

    setcookie("ip",0,time()-1);
    unset($_COOKIE['ip']);

    header('Location: index.php');
    }

    $key = uniqid();
	if($connection->connect_errno!=0)
	{
		echo "Error:".$connection->connect_errno;
	}
	else
	{
		$login = $_COOKIE['login'];
        mysqli_connect($host, $db_user, $db_password) 
        or die("cannot connect to database\n");
        mysqli_select_db($connection, "gkozlowski") or die(mysql_error());
		mysqli_query($connection, "SET AUTOCOMMIT=0");
		mysqli_query($connection, "SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		mysqli_query($connection, "START TRANSACTION");
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
		if($log_res = mysqli_query($connection, sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s'", mysqli_real_escape_string($connection,$login))))
		{

				$u =mysqli_fetch_assoc($log_res);
				$ID = $_GET['id'];
				$gra = mysqli_query($connection, sprintf("SELECT * FROM Gry WHERE Id_gry='%s'", mysqli_real_escape_string($connection,$ID)))
					or die("buuu");
				$g = mysqli_fetch_assoc($gra);

				if($g['Cena'] < $u['Stan_konta'])
				{
					
					date_default_timezone_set('Europe/Berlin');
					$date = strftime("%F %T");
					$Stan_konta = $u['Stan_konta'];
					$cena = $g['Cena'];
					$nowa = $Stan_konta-$cena;
					echo $nowa."</br>";
					$tr1 = mysqli_query($connection, sprintf("INSERT INTO Kluczewolne (Klucz, Data_zakupa, id_gry,id_gracz) VALUES ('%s', '%s' , '%s','%s')",mysqli_real_escape_string($connection,$key),mysqli_real_escape_string($connection,$date),mysqli_real_escape_string($connection,$g['Id_gry']),mysqli_real_escape_string($connection,$u['Id_uzytkownika'])))
					or die($g['Id_gry'].' '.$key);
					$tr2 = mysqli_query($connection, sprintf("UPDATE Uzytkownicy SET Stan_konta ='%s' WHERE nazwa_uzytkownika ='%s'",mysqli_real_escape_string($connection,$nowa),mysqli_real_escape_string($connection,$_COOKIE['login'])))
					or die("ERROR");

					if ($tr1 and $tr2 and $log_res) {
                            mysqli_query($connection, "COMMIT");
                            mysqli_query($link, "COMMIT");
							mysqli_query($link, "SET AUTOCOMMIT=1");
							setcookie('buycorr',1,time()+60,$secure=true);
							header('Location: zakupiono.php');
							echo $key;
                        } else {
                            mysqli_query($connection, "ROLLBACK");
                            setcookie('buyfail',1,time()+60,$secure=true);
							header('Location: niezakupiono.php');
							echo "niewystarczające środki na koncie";
                        }
				

				
			}
			else 
			{
				mysqli_query($connection, "ROLLBACK");
                setcookie('buyfail',1,time()+60,$secure=true);
				header('Location: niezakupiono.php');
				echo "niewystarczające środki na koncie";
			}
		}
		else 
			{
				mysqli_query($connection, "ROLLBACK");
                setcookie('buyfail',1,time()+60,$secure=true);
				header('Location: niezakupiono.php');
				echo "niewystarczające środki na koncie";
			}
		}
	
				
					

?>

<!DOCTYPE html>
<html lang="pl">
<?php include('header.html');?>
<body>

<?php
?>

</body>
</html>

<?php
require 'database.php';
?>
