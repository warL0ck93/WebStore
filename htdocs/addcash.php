<?php
    header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");


    require 'database.php';

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);

    if(isset($_COOKIE['id']))
    {

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


$error = "";

    



    
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
            <span class="bigtitle">Doładuj konto</span>
            
            <div class="dottedline"></div>

            <form action="addcash.php" method = "post">
        ile chcesz wpłacić: </br><input type="text" onBlur="checkNumeric(this.value)" name="val"/></br> 
        <div id='div1'> </div></br>
        numer karty   : </br><input type="text" name="card"/></br> 
        <input type="submit" value="Dodaj"/> 
    </form>
    <?php
    if((isset($_POST['val']) && isset($_POST['card'])))
    {    
        if(is_numeric($_POST['val']) && is_numeric($_POST['card']))
        {
            $card = $_POST['card'];

            if(strlen($card)!=16)
            {
                 echo "Niepoprawny numer karty";
            }
            else
            {
        $wynik = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika ='%s'", mysqli_real_escape_string($connection,$_COOKIE['login'])))
        or die("error");

        $how_many = $wynik->num_rows;
        if($how_many>0)
        {
            $res = $wynik->fetch_assoc();
            $stan = $res['Stan_konta'];
            if($_POST['val']<0)
            {
                $error = "Nieprawidłowa kwota wpłacana";
            }
            else
            {
                $stan+= intval($_POST['val']);
                @$connection->query(sprintf("UPDATE Uzytkownicy SET Stan_konta='%s' WHERE nazwa_uzytkownika='%s'", mysqli_real_escape_string($connection,$stan),mysqli_real_escape_string($connection,$_COOKIE['login'])))
        or die($_POST['kraj']);
              header('Location: konto.php');  
            }
        }

        
}
        }
        else
        {   
            $card = $_POST['card'];
            if(!is_numeric($_POST['val']))
            {
                echo "Suma wpłacana musi być liczbą ";
            }
            if(!is_numeric($_POST['card']))
            {
                echo "Niepoprawny numer karty";
            }
            elseif(strlen($card)!=16)
            {
                 echo "Niepoprawny numer karty";
            }
            
        }
    }
    if(isset($_POST['val']))
            {
                if($_POST['val']<0)
                {
                    echo "</br> NIEPRAWIDŁOWA SUMA WPŁACANA";
                }
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
