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
    if(isset($_POST['comment']))
    {
        $wynik = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika = '%s'",mysqli_real_escape_string($connection,$_COOKIE['login'])))
    or die("błąd wyboru uzykownika");
        $how_many = $wynik->num_rows;
        if($how_many>0)
        {
            $commentarz = $_POST['comment'];
            $lol= $_GET['id'];
            $r = $wynik->fetch_assoc();
            date_default_timezone_set('Europe/Berlin');
            $date = strftime("%F %T");
            $wynik = @$connection->query(sprintf("INSERT INTO Komentarze (id_kgry, id_kuzyt, Komentarz,Data) Values ('%s','%s','%s','%s')",mysqli_real_escape_string($connection,$lol),mysqli_real_escape_string($connection,$r['Id_uzytkownika']),mysqli_real_escape_string($connection,$commentarz),mysqli_real_escape_string($connection,$date)))
    or die("błąd dodawania komentarza");
        }

    }


    if(isset($_POST['nowa_ocena']))
    {  
        $Identify = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika = '%s'",mysqli_real_escape_string($connection,$_COOKIE['login'])));
        $how_many = $Identify->num_rows;
        if($how_many>0)
        {
            $r = $Identify->fetch_assoc();
            $oceniana = @$connection->query(sprintf("SELECT * FROM Ocena Where id_uzytkownika='%s' AND id_gry = '%s'",mysqli_real_escape_string($connection,$r['Id_uzytkownika']),mysqli_real_escape_string($connection,$_GET['id'])))
            or die("Błąd pobierania oceny");
            $how_many=$oceniana->num_rows;
            if($how_many>0)
            {
                @$connection->query(sprintf("UPDATE Ocena SET Ocena='%s' Where id_uzytkownika='%s' AND id_gry = '%s'",mysqli_real_escape_string($connection,$_POST['nowa_ocena']), mysqli_real_escape_string($connection,$r['Id_uzytkownika']),mysqli_real_escape_string($connection,$_GET['id'])))
                or die($how_many);
            }
            else
            {
                @$connection->query(sprintf("INSERT INTO Ocena (Ocena, id_gry,id_uzytkownika) Values ('%s','%s','%s') ",mysqli_real_escape_string($connection,$_POST['nowa_ocena']), mysqli_real_escape_string($connection,$_GET['id']),mysqli_real_escape_string($connection,$r['Id_uzytkownika'])))
                or die("INS OCENA ERROR");
            }
        }
    }
    $idek='%'.$_GET['id'].'%';
    $wynik = @$connection->query(sprintf("SELECT Gry.Id_gry AS id_gry, Gry.Opis AS Opis, Gry.nazwa_gry AS nazwa_gry,Gry.Cena AS cena,`Gry`.`Data_wydania` AS `data_wydania`,`Producenci`.`Nazwa_producenta` AS `Nazwa_producenta`,`Gatunek`.`nazwa_gatunek` AS `nazwa_gatunek` from ((`Gry` join `Producenci` on((`Gry`.`id_producent` = `Producenci`.`ID_Producent`))) join `Gatunek` on((`Gry`.`id_gatunek` = `Gatunek`.`id_gatunek`))) WHERE id_gry LIKE '%s'",mysqli_real_escape_string($connection,$idek)))
    or die("błąd zapytania");
    $srednia =@$connection->query(sprintf("SELECT `Gry`.`Id_gry` AS `Id_gry`,`Gry`.`nazwa_gry` AS `nazwa_gry`,avg(`Ocena`.`Ocena`) AS `Ocena` from (`Gry` join `Ocena` on((`Gry`.`Id_gry` = `Ocena`.`id_gry`)))  GROUP BY `Gry`.`Id_gry`,`Gry`.`nazwa_gry`",mysqli_real_escape_string($connection,$_GET['id'])))
    or die("błąd zapytania");

    $iczbaoc =@$connection->query(sprintf("SELECT `Gry`.`Id_gry` AS `Id_gry`,`Gry`.`nazwa_gry` AS `nazwa_gry` from (`Gry` join `Ocena` on((`Gry`.`Id_gry` = `Ocena`.`id_gry`)))  WHERE `Gry`.`Id_gry` = '%s'",mysqli_real_escape_string($connection,$_GET['id'])))
    or die("błąd zapytania");
    $how_many = $wynik->num_rows;
    $how_many2 = $iczbaoc->num_rows;

    $wynik2 = @$connection->query(sprintf("SELECT Gry.Id_gry AS id_gry, Komentarze.Komentarz AS Komentarz, Komentarze.Data AS Data,Uzytkownicy.nazwa_uzytkownika AS login from ((`Komentarze` join `Gry` on((`Komentarze`.`id_kgry` = `Gry`.`Id_gry`))) join `Uzytkownicy` on((`Komentarze`.`id_kuzyt` = `Uzytkownicy`.`id_uzytkownika`))) WHERE id_gry LIKE '%s'",mysqli_real_escape_string($connection,$idek)))
    or die("błąd zapytania");
    $how_many3=$wynik2->num_rows;

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
    <?php
    $okr_stat = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s' ", mysqli_real_escape_string($connection,$_COOKIE['login'])))
        or die("Błąd zapytania");
        
        $r=$okr_stat->fetch_assoc();
        if($r['Stat']=='Admin')
        {
            echo '<a href="editgame.php?id='.$_GET['id'].'"> EDYTUJ</a>';
        }
    ?>
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
                <?php
                if(isset($_COOKIE['id']))
                {
                echo '<form action="gra.php?id='.$_GET['id'].'" method = "post">
                    <select name="nowa_ocena">
                    <option value= "1">1</option>
                    <option value= "2">2</option>
                    <option value= "3">3</option>
                    <option value= "4">4</option>
                    <option value= "5">5</option>
                    <option value= "6">6</option>    
                </select>
                <input type="submit" value="OCEŃ"/> 
                </form>';
                }
                ?>
            </div>
            <div id="topbarR">
                <span class="bigtitle">
                <?php
                    if($how_many2>0){
                    while($s = $srednia->fetch_assoc()) 
                    {
            
                    if($s['Id_gry'] == $_GET['id'])
                    {
                        echo "Średnia ocen :".$s['Ocena']; 
                    }
                }
                }
                ?>
                </span>
                <div style="height: 15px;"></div>
                <?php
                    if($how_many2>0){
                    
                        echo "Liczba ocen: ".$how_many2; 
                    }
                
            
                ?>
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
            if(isset($_COOKIE['id']))
            {
            echo '<form action="zakup.php?id='.$id.'" method = "post">
            Cena : '.$r['cena'].'zł
            <input type="submit" value="Kup"/> 
            </form>';
            }
            }?>               
            </span>
            
            <div class="dottedline"></div>
            
             <?php 


    if($how_many > 0 ) 
    {         
            
            echo "Gatunek     : ".$r['nazwa_gatunek']."</br>";
            echo "Producent   : ".$r['Nazwa_producenta']."</br>";
            echo "Data Wydania: ".$r['data_wydania']."</br>";
            echo "</br> </br>";
            if(isset($r['Opis']))
            {
            echo "Opis: ".$r['Opis']."</br>";
            }
    } 
    ?>
    </div>
    <style>
textarea {
width:730px;
max-width:730px;
min-width:730px;

height:100px;
max-height:100px;
min-height:100px;
}

</style>

    <?php
    if($how_many3>0)
    {

         while($kom = $wynik2->fetch_assoc()) 
                {
                    echo'
 
        <div id="comment">
            <div id="topbarL">'
                .htmlentities($kom['login'],ENT_QUOTES, "UTF-8").
            '</br></div>
            <div id="topbarR">
            <span class="commdata">'.htmlentities($kom['Data'],ENT_QUOTES, "UTF-8").'</span>
                <div style="height: 15px;"></div>'
                .htmlentities($kom['Komentarz'],ENT_QUOTES, "UTF-8").'
            </div>
        </div>';
       

                           
                }

        

    }
    if(isset($_COOKIE['id']))
    {
    echo '

        <div id="comment">
            <div id="topbarL">
            </div>
                <div style="height: 15px;"></div><form action="gra.php?id='.$_GET['id'].'" method = "post">
                <textarea name="comment" id="comment"></textarea><br/>
        <input type="submit" value="Komentuj"/> 
    </form>';
    }   
?>
 <div id="footer">
            Poznaj nową platformę zarządzania swoimi grami. &copy; Wszelkie prawa zastrzeżone
        </div>
    
    </div>
</body>
</html><body onload="AcceptCookies()">
<?php
require 'database.php';
?>