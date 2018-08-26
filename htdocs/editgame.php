<?php
header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");
    require 'database.php';

            $connection = @new mysqli($host, $db_user, $db_password, $db_name);
	$okr_stat = @$connection->query(sprintf("SELECT * FROM Uzytkownicy WHERE nazwa_uzytkownika='%s' ", mysqli_real_escape_string($connection,$_COOKIE['login'])))
        or die("Błąd zapytania");
        
        $r=$okr_stat->fetch_assoc();
        if($r['Stat']=='User')
            header('Location: index.php');


    if(isset($_COOKIE['id']))
    {
        $host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "gkozlowski";

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
    if((isset($_POST['nazwa'])) && (isset($_POST['gatun']) && isset($_POST['prod']) && isset($_POST['cena'])))
    {       
    
        if(!is_numeric($_POST['cena']))
        {
            setcookie('zlacena',"Cena musi być liczbą",time()+3600);
            header('Location: newgame.php');
        }
        else
        {
        $nazwa = $_POST['nazwa'];
        echo $_POST['nazwa'];
        $cena = $_POST['cena'];
        $gat = $_POST['gatun'];
        echo $_POST['gatun'];
        $prod = $_POST['prod'];
        echo $_POST['prod'];
        $cena = htmlentities($cena, ENT_QUOTES, "UTF-8");
        $nazwa = htmlentities($nazwa, ENT_QUOTES, "UTF-8");
        $gat= htmlentities($gat, ENT_QUOTES, "UTF-8");
        $prod= htmlentities($prod, ENT_QUOTES, "UTF-8");
        $ID=$_GET['id'];
        $idek='%'.$_GET['id'].'%';
        if($log_res = @$connection->query(sprintf("UPDATE Gry SET nazwa_gry = '%s', id_producent ='%s', id_gatunek='%s',Cena='%s', Opis='%s' WHERE Id_gry= '%s'", mysqli_real_escape_string($connection,$nazwa), mysqli_real_escape_string($connection,$prod),mysqli_real_escape_string($connection,$gat), mysqli_real_escape_string($connection, $cena),mysqli_real_escape_string($connection,$_POST['comment']),mysqli_real_escape_string($connection,$ID))))
        {
              header('Location: admin.php');  

        }
        else
        {
            echo mysql_errno($connection);
        }
    }

    
}
$ID=$_GET['id'];
$idek='%'.$_GET['id'].'%';
    $wynik = @$connection->query(sprintf("SELECT Gry.Id_gry AS id_gry, Gry.Opis AS Opis, Gry.nazwa_gry AS nazwa_gry,Gry.Cena AS cena,`Gry`.`Data_wydania` AS `data_wydania`,`Producenci`.`Nazwa_producenta` AS `Nazwa_producenta`,`Gatunek`.`nazwa_gatunek` AS `nazwa_gatunek` from ((`Gry` join `Producenci` on((`Gry`.`id_producent` = `Producenci`.`ID_Producent`))) join `Gatunek` on((`Gry`.`id_gatunek` = `Gatunek`.`id_gatunek`))) WHERE id_gry LIKE '%s'",mysqli_real_escape_string($connection,$idek)))
    or die("błąd zapytania");
    $w= $wynik->fetch_assoc();

    
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
            <span class="bigtitle">Edytuj Gre</span>
            
            <div class="dottedline"></div>
            <form action=<?php echo '"editgame.php?id='.$ID.'"'; ?> method = "post">
        Nazwa: <input type="text" name="nazwa" value=<?php echo '"'.$w['nazwa_gry'].'"';?> /></br> </br> Gatunek:
        <?php
            $host = "localhost";
            $db_user = "root";
            $db_password = "";
            $db_name = "gkozlowski";

            $connection = @new mysqli($host, $db_user, $db_password, $db_name);

            $zapytanie = @$connection->query("SELECT * FROM Gatunek");
            echo '<select id="gatun" name="gatun">';
            while($option = $zapytanie->fetch_assoc()) {
                echo '<option value="'.$option['id_gatunek'].'">'.$option['nazwa_gatunek'].'</option>';
            }
            echo '</select>';
        ?>
        </br>
        </br>Producent:
        <?php
            
            $zapytanie = @$connection->query("SELECT * FROM Producenci");
            echo '<select id="prod" name="prod">';
            while($option = $zapytanie->fetch_assoc()) {
                echo '<option value="'.$option['ID_Producent'].'">'.$option['Nazwa_producenta'].'</option>';
            }
            echo '</select>';
        ?>
        </br>
        Cena:</br> <input type="text" name="cena" value = <?php echo '"'.$w['cena'].'"';?> name ="cena"/></br>
        <?php
            if(isset($_COOKIE['zlacena']))
                echo "</br>".$_COOKIE['zlacena']."</br>";
        ?>
        Opis:</br><textarea name="comment" id="comment" value = <?php echo '"'.$w['Opis'].'"';?>></textarea><br/></br>
        <input type="submit" value="Zatwierdz"/> 
    </form>    
            
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