<?php 
header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");


    require 'database.php';

    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
    setcookie('buyprocedure',$_GET['id'],time()+60,$secure=true);
    if(isset($_COOKIE['id']))
    {
        

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

    $idek='%'.$_GET['id'].'%';
    $wynik = @$connection->query(sprintf("SELECT Gry.Id_gry AS id_gry, Gry.Opis AS Opis, Gry.nazwa_gry AS nazwa_gry,Gry.Cena AS cena,`Gry`.`Data_wydania` AS `data_wydania`,`Producenci`.`Nazwa_producenta` AS `Nazwa_producenta`,`Gatunek`.`nazwa_gatunek` AS `nazwa_gatunek` from ((`Gry` join `Producenci` on((`Gry`.`id_producent` = `Producenci`.`ID_Producent`))) join `Gatunek` on((`Gry`.`id_gatunek` = `Gatunek`.`id_gatunek`))) WHERE id_gry LIKE '%s'",mysqli_real_escape_string($connection,$idek)))
    or die("error");
    $how_many = $wynik->num_rows;


?>

<!DOCTYPE html>
<html lang="pl">
<?php include('header.html');?>
<body>
<script src="http://cookiealert.sruu.pl/CookieAlert-latest.min.js"></script>
<script>CookieAlert.init();</script>
<div id="container">
<div id="cookies" style="line-height: normal; visibility:hidden;">
        <span>Ta strona używa ciasteczek (cookies), dzięki którym nasz serwis może działać lepiej.</span>
        <input id="cookie-accept" type="button" value="Akceptuję" onclick="AcceptCookies(1)" />
    </div>

        <div id="logo">
            Steam 2.0
        </div>
        
        <div id="menu">
            <a href = "wyszukiwarka.php"><div class="option">Przeglądaj gry</a></div>
            <?php
            if(!isset($_COOKIE['login']))
            {   

                echo '<a href = "loginscreen.php"><div class="option">Zaloguj</a></div>
                      <a href = "zarejestrujsie.php"><div class="option">Zarejestruj się</a></div>';
            }
            else
            {
                echo '<a href = "konto.php"><div class="option">Konto</a></div>
                      <a href = "wyloguj.php"><div class="option">Wyloguj</a></div>';
            }
            require 'minisearch.php';
            ?>
            <div style="clear:both;"></div>
        </div>
        
            <div id="topbar">
            <div id="topbarL">
                <img src="linux.png" />
            </div>
            <div id="topbarR">
                <span class="bigtitle">CZY NA PEWNO CHCESZ KUPIĆ GRĘ</span>
                <div style="height: 15px;"></div>
                
            </div>
            <div style="clear:both;"></div>
        </div>
        
        <div id="sidebar">
            <a href = "index.php" style = "color: black;"><div class="optionL">Strona główna</div></a>
            <a href = "wyszukiwarka.php" style = "color: black;"><div class="optionL">Przeglądaj gry</div></a>
            <a href = "about.php" style = "color: black;"><div class="optionL">O mnie</div></a>
            <a href = "contact.php" style = "color: black;"><div class="optionL">Kontakt</div></a>
        </div>
        
        <div id="content">
            <span class="bigtitle">
            <?php
            if($how_many > 0 ) 
            { 
                 $r = $wynik->fetch_assoc();
            echo $r['nazwa_gry'];

            $id = $_GET['id'];
            
            }?>               
            </span>
            
            <div class="dottedline"></div>
            
             <?php 


    if($how_many > 0 ) 
    {         
            echo "czy na pewno chcesz kupić tą grę ?</br>";
            echo "Gatunek     : ".$r['nazwa_gatunek']."</br>";
            echo "Producent   : ".$r['Nazwa_producenta']."</br>";
            echo "Data Wydania: ".$r['data_wydania']."</br>";
            echo "</br> </br>";
            if(isset($_COOKIE['id']))
            {
            echo '<form action="kup.php?id='.$id.'" method = "post">
            Cena : '.$r['cena'].'zł
            <input type="submit" value="Kup"/> 
            </form>';
            }
    } 
    ?>
    </div>
    <style>
textarea {
width:300px;
max-width:300px;
min-width:300px;

height:100px;
max-height:100px;
min-height:100px;
}

</style>

 <div id="footer">
            Poznaj nową platformę zarządzania swoimi grami. &copy; Wszelkie prawa zastrzeżone
        </div>
    
    </div>
</body>
</html><body onload="AcceptCookies()">
<?php
require 'database.php';
?>