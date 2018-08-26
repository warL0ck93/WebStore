<?php
header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");
    if(isset($_COOKIE['id'])&& $_COOKIE['id']!=0)
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
            setcookie("id",null,time()-1);
            unset($_COOKIE['id']);

            setcookie("login",null,time()-1);
            unset($_COOKIE['login']);

            setcookie("ip",null,time()-1);
            unset($_COOKIE['ip']);
            setcookie('blad','Nastąpiło wylogowanie spowodowane logowaniem z innej lokalizacji',time()+3600);
            header('Location: index.php');
        }
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
            <a href = "wyszukiwarka.php" onclick="this.visibility= hidden"><div class="option">Przeglądaj gry</a></div>
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
            <span class="bigtitle">Czym jest Steam?</span>
            
            <div class="dottedline"></div>
            
            Steam – platforma dystrybucji cyfrowej i zarządzania prawami cyfrowymi, system gry wieloosobowej oraz serwis społecznościowy stworzony przez Valve Corporation.

            <br /><br />
            W październiku 2012 roku Valve rozszerzyło ofertę o oprogramowanie niebędące grami. Steam pozwala użytkownikowi na instalację i automatyczne zarządzanie oprogramowaniem na wielu komputerach oraz dostarcza funkcje społecznościowe takie jak listy znajomych i grupy, zapis w chmurze, rozmowy głosowe oraz czat dostępny podczas gry. Steam zapewnia ogólnodostępny interfejs programowania aplikacji (API) zwany Steamworks, który może być użyty przez programistów do zintegrowania z ich produktami takich funkcji platformy Steam jak zabezpieczenie przed kopiowaniem, funkcje sieciowe i matchmaking, osiągnięcia w grach, mikropłatności oraz wsparcie dla zawartości tworzonej przez użytkowników w Steam Workshop.
            
            <br /><br />            
            Steam zastąpił WON, oryginalny system gry wieloosobowej dla gry Half-Life. Odegrał ważną rolę na rynku gier komputerowych, na jego wzór powstały inne systemy antypirackie. Program jest dostępny na platformy Windows, PS3, OS X, iOS oraz Android. 14 lutego 2013 udostępniono wersję klienta na systemy linuksowe. Według danych z lutego 2015 roku z platformy korzysta ok. 125 milionów aktywnych użytkowników.
        </div>  
        
        <div id="footer">
            Poznaj nową platformę zarządzania swoimi grami. &copy; Wszelkie prawa zastrzeżone
        </div>
    
    </div>
    <div id="cookies" style="line-height: normal; visibility:hidden;">
        <span>Ta strona używa ciasteczek (cookies), dzięki którym nasz serwis może działać lepiej.</span>
        <input id="cookie-accept" type="button" value="Akceptuję" onclick="AcceptCookies(1)" />
    </div>
</body>
</html><body onload="AcceptCookies()">

<?php
require 'database.php';
?>