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
    if((isset($_POST['nazwa'])))
    {       
    

    if($connection->connect_errno!=0)
    {
        echo "Error:".$connection->connect_errno;
    }
    else
    {

        $nazwa = $_POST['nazwa'];
        echo $_POST['nazwa'];
        $gat = $_POST['gatun'];
        echo $_POST['gatun'];
        $prod = $_POST['prod'];
        echo $_POST['prod'];
        $nazwa = htmlentities($nazwa, ENT_QUOTES, "UTF-8");
        $gat= htmlentities($gat, ENT_QUOTES, "UTF-8");
        $prod= htmlentities($prod, ENT_QUOTES, "UTF-8");
        if($log_res = @$connection->query(sprintf("INSERT INTO Gatunek (nazwa_gatunek) VALUES ('%s')", mysqli_real_escape_string($connection,$_POST['nazwa']))))
        {
              header('Location: admin.php');  

        }
        else
        {
            echo $log_res->query_errno;
        }

    }
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
            <span class="bigtitle">NOWY GATUNEK</span>
            
            <div class="dottedline"></div>
            <form action="newgat.php" method = "post">
                Nowy gatunek: <input type="text" name="nazwa" text="Wpisz wyszukiwaną fraze"/></br> 
                <input type="submit" value="Dodaj"/> 
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