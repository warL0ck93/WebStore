<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");
    require 'database.php';

            $connection = @new mysqli($host, $db_user, $db_password, $db_name);


    if(isset($_COOKIE['id']))
    {
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
        }
        else
        {
            setcookie('blad',$check,time()+3600);
            @$connection->query(sprintf("DELETE FROM Sesja WHERE login='%s'", mysqli_real_escape_string($connection,$_COOKIE['login'])));
            setcookie("id",0,time()-1);
            unset($_COOKIE['id']);

            setcookie("login",0,time()-1);
            unset($_COOKIE['login']);

            setcookie("ip",0,time()-1);
            unset($_COOKIE['ip']);
            setcookie('blad','Nastąpiło wylogowanie spowodowane logowaniem z innej lokalizacji',time()+3600);
            header('Location: index.php');
        }
    }
    else
    {
        header('Location: index.php');
    }




    if((isset($_POST['oldpas']) && isset($_POST['newpas']) && isset($_POST['newpasrep']) && $_POST['newpasrep'] == $_POST['newpas'] ))
    {       
        

        $login=$_COOKIE['login'];
        $password = $_POST['oldpas'];
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        if($log_res = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s'", mysqli_real_escape_string($connection,$login))))
        {
            $how_many = $log_res->num_rows;
            
            if($how_many>0)
            {
                $r = $log_res->fetch_assoc();
                $sol = $r['sol'];
                $password = sha1(sha1($password.$sol).$sol);
                $password = htmlentities($password, ENT_QUOTES, "UTF-8");
                if($log_res = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s'  AND haslo = '%s'", mysqli_real_escape_string($connection,$login),mysqli_real_escape_string($connection,$password))))
                {

                    $how_many = $log_res->num_rows;

                    if($how_many>0)
                    {


                        $wiersz = $log_res->fetch_assoc();
                        
                        $password = $_POST['newpas'];
                        $password = sha1(sha1($password.$sol).$sol);
                        $password = addslashes($password);
                        @$connection->query(sprintf("UPDATE Uzytkownicy SET haslo='%s' WHERE nazwa_uzytkownika = '%s'", mysqli_real_escape_string($connection,$password), mysqli_real_escape_string($connection,$login) ))
                        or die("error sql"); 
                        $error="Nowe hsało wprowadzone";       
                    }
                    else
                    {
                        $error="Stare hasło jest niepoprawne";
                    }
                }

            }
            else
            {
                $error="Stare hasło jest niepoprawne";

            }
        }
        else
        {
            echo "nie zadzialalo";
        }
   }
   else
   {
    if(isset($_POST['oldpas']) || isset($_POST['newpas']))
        $error="Hasła nie są takie same";
   }



    
?>
<!DOCTYPE html>
<html lang="pl">
<?php include('header.html');?>
<body>
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
            <span class="bigtitle">Zmiana hsała!</span>
            
            <div class="dottedline"></div>
            
            
            <form action="newpass.php" method = "post">
        Stare hasło  :</br> <input type="password" name="oldpas"/></br> 
        Nowe hasło   :</br> <input type="password" name="newpas"/></br> 
        Potwierdź hasło:</br> <input type="password" name="newpasrep"/></br> 
        <input type="submit" value="Dodaj"/> 
         </form>
         <?php
            if(isset($error))
            {
                echo "</br>".$error;
            }
         ?>
            
        </div>  
        
        <div id="footer">
            Poznaj nową platformę zarządzania swoimi grami. &copy; Wszelkie prawa zastrzeżone
        </div>
    
    </div>

</body>
</html><body onload="AcceptCookies()">
<?php
require 'database.php';
?>