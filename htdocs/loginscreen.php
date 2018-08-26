<?php
	header("Cache-Control: no-store, no-cache, must-revalidate");  
	header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
	header("Pragma: no-cache");
    if(isset($_COOKIE['id']))
    {
        header("Location: index.php");
        exit();
    }

  
?>

<!DOCTYPE html>
<html lang="pl">
<?php include('header.html');?>
<body>
<script src="http://cookiealert.sruu.pl/CookieAlert-latest.min.js"></script>
<script>CookieAlert.init();</script>
<?php
    if(isset($_COOKIE['id']))
    {
        header("Location: index.php");
        exit();
    }

?>

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
            <span class="bigtitle">Logowanie</span>
            
            <div class="dottedline"></div>
            
             <form action="zaloguj.php" method = "post" onsubmit="return blocade()">
            Login: <br/><input type="text" name="login"/><br/>
            Hasło: <br/><input type="password" name="password"/><br/><br/>
            <input type="submit" value="Zaloguj się"/>  
        <br/>
    </form>
        </div>  
        
        <div id="footer">
            Poznaj nową platformę zarządzania swoimi grami. &copy; Wszelkie prawa zastrzeżone
        </div>
    
</body>
</html><body onload="AcceptCookies()">

<?php
require 'database.php';
?>
