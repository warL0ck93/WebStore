<?php
header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");

    require 'database.php'; 

        $connection = @new mysqli($host, $db_user, $db_password, $db_name);
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
    if(!isset($_POST['wyszukiwana']))
        {

        $wynik = @$connection->query(sprintf("SELECT Gry.Id_gry AS id_gry, Gry.nazwa_gry AS nazwa_gry,`Gry`.`Data_wydania` AS `data_wydania`,`Producenci`.`Nazwa_producenta` AS `Nazwa_producenta`,`Gatunek`.`nazwa_gatunek` AS `nazwa_gatunek` from ((`Gry` join `Producenci` on((`Gry`.`id_producent` = `Producenci`.`ID_Producent`))) join `Gatunek` on((`Gry`.`id_gatunek` = `Gatunek`.`id_gatunek`))) "))
        or die('Błąd zapytania');
        $how_many = $wynik->num_rows;
        }

    else
    {       

            $szukana= htmlentities($_POST['wyszukiwana'], ENT_QUOTES, "UTF-8");
            $gatuneczek= htmlentities($_POST['gatun'], ENT_QUOTES, "UTF-8");
            $gatunek='%'.$gatuneczek.'%';
            $fraza='%'.$szukana.'%';
            setcookie('blad',$fraza,time()+3600);
            $wynik = @$connection->query(sprintf("SELECT Gry.Id_gry AS id_gry, Gry.nazwa_gry AS nazwa_gry,`Gry`.`Data_wydania` AS `data_wydania`,`Producenci`.`Nazwa_producenta` AS `Nazwa_producenta`,`Gatunek`.`nazwa_gatunek` AS `nazwa_gatunek` from ((`Gry` join `Producenci` on((`Gry`.`id_producent` = `Producenci`.`ID_Producent`))) join `Gatunek` on((`Gry`.`id_gatunek` = `Gatunek`.`id_gatunek`))) WHERE nazwa_gry LIKE '%s'  AND nazwa_gatunek LIKE '%s'",mysqli_real_escape_string($connection,$fraza),mysqli_real_escape_string($connection,$gatunek)))
        or die("błąd zapytania");
        setcookie('blad',$_POST['gatun'],time()+3600);
        $how_many = $wynik->num_rows;
    }
  
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
            <a href = "wyszukiwarka.php" style = "color: white;"><div class="option">Przeglądaj gry</a></div>
            <?php
            if(!isset($_COOKIE['login']))
            {   

                echo '<a href = "loginscreen.php" style = "color: white;"><div class="option">Zaloguj</a></div>
                      <a href = "zarejestrujsie.php" style = "color: white;"><div class="option">Zarejestruj się</a></div>';
            }
            else
            {
                echo '<a href = "konto.php" style = "color: white;"><div class="option">Konto</a></div>
                      <a href = "wyloguj.php" style = "color: white;"><div class="option">Wyloguj</a></div>';
            }
            ?>
            <div style="clear:both;"></div>
        </div>
        
        <div id="topbar">
            <div id="topbarL">
                <img src="linux.png" />
            </div>
            <div id="topbarR">
                <span class="bigtitle">O projekcie słów kilka</span>
                <div style="height: 15px;"></div>
                Witaj na tej stronie znajdziesz swoje gry a także uzyskasz do nich pełen dostęp
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
            <span class="bigtitle">Gry</span>
            
            <div class="dottedline"></div>
            
            <form action="wyszukiwarka.php" method = "post">
        <br/><input type="search" name="wyszukiwana" text="Wpisz wyszukiwaną fraze"/>
            
        <style>
        a:link {
        text-decoration: none;
        color: black;
        }

        a:visited {
        text-decoration: none;
        color: black;
        }
        </style>
        <?php
            $zapytanie = @$connection->query("SELECT * FROM Gatunek");
            echo '<select id="gatun" name="gatun">';
            while($option = $zapytanie->fetch_assoc()) {
                echo '<option value="'.$option['nazwa_gatunek'].'">'.$option['nazwa_gatunek'].'</option>';
            }
            echo '</select>';
        ?>
        <input type="submit" value="Wyszukaj"/>  
        <br/>
    </form>

    <?php


    

        echo "<table cellpadding=\"2\" border=1>";
        while($r = $wynik->fetch_assoc()) 
        {
            $ID=$r['id_gry'];
            echo "<tr>";
            echo "<td><a href = 'gra.php?id=$ID' >".$r['nazwa_gry']."</a></td>";
            echo "<td>".$r['nazwa_gatunek']."</td>";
            echo "<td>".$r['Nazwa_producenta']."</td>";
            echo "<td>".$r['data_wydania']."</td>";
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
