<?php
	
    header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");
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
    if(isset($_POST['klucz']))
    {
		if($connection->connect_errno!=0)
		{
			echo "Error:".$connection->connect_errno;
		}
		else
		{
			$login = $_COOKIE['login'];
	        
	        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
			if($log_res = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s'", mysqli_real_escape_string($connection,$login))))
			{
				$how_many = $log_res->num_rows;
				

				if($how_many>0)
				{
					$u = $log_res->fetch_assoc();
					$key = $_POST['klucz'];

					$kluczyk = @$connection->query(sprintf("SELECT * FROM Kluczewolne WHERE Klucz='%s'", mysqli_real_escape_string($connection,$key)))
						or die("buuu");
                    $key = mysqli_real_escape_string($connection,$key);
					
					$how_many = $kluczyk->num_rows;
					if($how_many>0)
					{

                        mysqli_connect($host, $db_user, $db_password) 
                            or die("cannot connect to database\n");
                        mysqli_select_db($connection, "gkozlowski") or die(mysql_error());
						mysqli_query($connection, "SET AUTOCOMMIT=0");
                        mysqli_query($connection, "SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE");
                        mysqli_query($connection, "START TRANSACTION");
                        $kluczyk = mysqli_query($connection, sprintf("SELECT id_gry, Klucz FROM Kluczewolne WHERE Klucz='%s'", mysqli_real_escape_string($connection,$key)))
                        or die("buuu");
                        $k = mysqli_fetch_row($kluczyk);
                        echo $k[1];
						$r1 = mysqli_query($connection, sprintf("INSERT INTO GryUzytkownikow (Id_gry, Id_Uzytkownika) VALUES ('%s', '%s')",mysqli_real_escape_string($connection,$k[0]),mysqli_real_escape_string($connection,$u['Id_uzytkownika'])))
						or die($kluczyk['id_gry']);
						$r2 = mysqli_query($connection, "DELETE FROM Kluczewolne WHERE Klucz ='$key'")
						or die(mysqli_error($connection));


                        if ($r1 and $r2 and $kluczyk) {
                            mysqli_query($connection, "COMMIT");
                            $dodano =true;
                        } else {
                            mysqli_query($connection, "ROLLBACK");
                            $dodano =false;
                        }
						
					}
                    else
                    {
                        $dodano =false;
                    }
				}
			}
		}
	}			
					

?>

<!DOCTYPE html>
<html lang="pl">
<?php include('header.html');?>
<body>
<noscript>
<strong>Uwaga!</strong> Twoja przeglądarka ma <strong>wyłączoną</strong> obsługę Javascript. <strong>Włącz</strong> ją aby poprawnie korzystać z serwisu.
</noscript>
<script src="http://cookiealert.sruu.pl/CookieAlert-latest.min.js"></script>
<script>CookieAlert.init();</script>
<div id="container">
<div id="cookies" style="line-height: normal; visibility:hidden;">
        <span>Ta strona używa ciasteczek (cookies), dzięki którym nasz serwis może działać lepiej.</span>
        <input id="cookie-accept" type="button" value="Akceptuję" onclick="AcceptCookies(1)" />
    </div> 
        
        <style>
            .optionL
            {
                font-size:18px;
                height:40px;
                padding: 10px;
                border-bottom: 2px outset #444444;  
            }
            a:link 
            {
            text-decoration: none;
            color: black;
            }

            a:visited 
            {
                text-decoration: none;
                color: black;
            }
        </style>
        <div id="sidebar">
            <div class="optionL"><a href="index.php">Strona główna</a></div>
            <div class="optionL"><a href="newpass.php">Zmien haslo</a></div>
            <div class="optionL"><a href="editinfo.php">Edytuj informacje</a></div>
            <div class="optionL"><a href="enterkey.php">Wprowadź klucz</a></div>
            <div class="optionL"><a href="addcash.php">DOLADUJ KONTO</a></div>
            <div class="optionL"><a href="Ugames.php">Twoje gry</a></div>
            <?php
            $okr_stat = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s' ", mysqli_real_escape_string($connection,$_COOKIE['login'])))
        or die("Błąd zapytania");
        
        $r=$okr_stat->fetch_assoc();
        if($r['Stat']=='Admin')
        {
                echo '<div class="optionL"><a href="newgame.php">DODAJ GRĘ</a></div>
                <div class="optionL"><a href="newprod.php">DODAJ PRODUCENTA</a></div>
                <div class="optionL"><a href="newgat.php">DODAJ GATUNEK</a></div>
                <div class="optionL"><a href="newkraj.php">DODAJ KRAJ</a></div>';
            }

            ?>
            <div class="optionL"><a href="wyloguj.php">Wyloguj się</a></div>

        </div>
        
        <div id="content">
            <span class="bigtitle">Wprowadź klucz</span>
            
            <div class="dottedline"></div>

            <form action="enterkey.php" method = "post">
                Wprowadź klucz:</br> <input type="text" name="klucz" id ="klucz"  onblur="chcekKey(this.value)" placeholder="KEY"/></br> 
                <input type="submit" value="Dodaj"/> 
                <?php
                    if(isset($dodano))
                    {
                        if($dodano)
                        {
                            echo "</br>Gra została pomyślnie dodana do twojego konta";

                        }
                        else
                        {
                            echo "</br>Wprowadzono błędny klucz";
                        }
                    }
                ?>
            </form>  
            <div id='div1'> </div>   
        </div>  
        
        <div id="footer">
            Poznaj nową platformę zarządzania grami. &copy; Wszelkie prawa zastrzeżone
        </div>
    
    </div>




</body>
<script>

function chcekKey(value)
{

    var len =value.length;
    if(len>13)
    {
        document.getElementById("div1").innerHTML="Klucz jest zbyt długi";
    }

    if(len<13)
    {
        document.getElementById("div1").innerHTML="Klucz jest zbyt krótki";
    }
}

</script>
</html><body onload="AcceptCookies()">
<?php
require 'database.php';
?>

