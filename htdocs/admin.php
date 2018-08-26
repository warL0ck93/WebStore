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

    $okr_stat = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s' ", mysqli_real_escape_string($connection,$_COOKIE['login'])))
        or die("Błąd zapytania");
        
        $r=$okr_stat->fetch_assoc();
        if($r['Stat']=='User')
            header('Location: index.php');
    }
    $okr_stat = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s' ", mysqli_real_escape_string($connection,$_COOKIE['login'])))
        or die("Błąd zapytania");
        
        $r=$okr_stat->fetch_assoc();
    $klucze = @$connection->query(sprintf("SELECT `Kluczewolne`.`Id_klucz_wolny` AS `idklucz`,`Kluczewolne`.`Klucz` AS `klucz`,`Gry`.`Id_gry` AS `id_gry`,`Gry`.`nazwa_gry` AS `Gra`,`Uzytkownicy`.`Id_uzytkownika` AS `Id_Uzyt` from ((`Kluczewolne` join `Gry` on((`Kluczewolne`.`id_gry` = `Gry`.`Id_gry`))) join `Uzytkownicy` on((`Kluczewolne`.`id_gracz` = `Uzytkownicy`.`Id_uzytkownika`))) WHERE `Uzytkownicy`.`Id_uzytkownika` = '%s' " , mysqli_real_escape_string($connection,$r['Id_uzytkownika'])))
    or die("zepsute");


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
                height:30px;
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
            <a href="index.php"><div class="optionL">Strona główna</div></a>
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
            <span class="bigtitle">PANEL ADMINA</span>
            
            <div class="dottedline"></div>
            <?php 

            echo "<p>Witaj ",$_COOKIE['login'],"! ";
            $log_res = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s' ", mysqli_real_escape_string($connection,$_COOKIE['login'])));
            $wiersz = $log_res->fetch_assoc();
            echo "</br> ADRES E-MAIL: ".$wiersz['adres_e_mail'];
            echo "</br> NR. TELEFONU: ".$wiersz['numer_tel'];
            echo "</br> Stan Konta: ".$wiersz['Stan_konta'];

            ?>  

            <?php


    
        echo "</br>TWOJE NIEWYKORZYSTANE KLUCZE:</br>";
        echo "<table cellpadding=\"2\" border=1>";
        while($r = $klucze->fetch_assoc()) 
        {
            $ID=$r['id_gry'];
            echo "<tr>";
            echo "<td>".$r['Gra']."</a></td>";
            echo "<td>".$r['klucz']."</td>";
            echo "</tr>";
        } 
        echo "</table>"
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
