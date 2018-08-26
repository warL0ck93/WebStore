<?php
	header("Cache-Control: no-store, no-cache, must-revalidate");  
    header("Cache-Control: post-check=0, pre-check=0, max-age=0", false);
    header("Pragma: no-cache");
    if(isset($_COOKIE['id']))
    {
        header("Location: index.php");
        exit();
    }  
//proba
            require 'database.php'; 

        $error="";
        $oke=true;
    $connection = @new mysqli($host, $db_user, $db_password, $db_name);
try
{
    if(isset($_POST['password']))
    {
    $password = $_POST['password'];
    $passowrd = htmlspecialchars($password);
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");
    $password = addslashes($password);
    $password = mysqli_real_escape_string($connection,$password);    
    }

    if(isset($_POST['password2']))
    {
    $password2 = $_POST['password2'];
    $passowrd2 = htmlspecialchars($password2);
    $password2 = htmlentities($password2, ENT_QUOTES, "UTF-8");
    $password2 = addslashes($password2);
    $password2 = mysqli_real_escape_string($connection,$password2);
    }
    $onregulamin="";


function isValid($email)
    {
    if(!preg_match("/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/i", $email))
      return false;
    return true;
    }

    if((!isset($_POST['login']))) 
    {
        $oke = false;
        $error = "Nie podano loginu";
    }    

    if((!isset($password)))
    {
        $oke = false;
        $error = "nie wprowadzono hasla";

    }
    else
    {
        if(strlen($password)<8)
    {
        $oke = false;
        $error = "hasło musi mieć co najmniej 8 znaków";

    }

     if(strlen($password)>50)
    {
        $oke = false;
        $error = "hasło może mieć najwyżej 50 znaków";

    }
    }

    if(!isset($_POST['regulamin']))
    {

       $oke=false;
       $onregulamin="Potwierdź akceptację regulaminu <br>";
    }

    if(isset($password2))
    {
    if( $password != $password2)
    {
        $oke =false;
        $error = "hasła się nie zgadzają";
    }
    }
    else
    {
         $oke =false;
    }
    if(isset($_POST['mail']))
{
    if(!isValid($_POST['mail']))
    {
        $oke= false;
        $error = "Niepoprawny adres e-mail";
    }
}
else
$oke=false;
    if(isset($_POST['login']))
    {
    if(strlen($_POST['login'])>20)
    {
        $oke = false;
        $error = "Login zbyt długi max 20 znaków";

    } 

    if(strlen($_POST['login'])<5)
    {
        $oke = false;
        $error = "Login zbyt krótki min 5 znaków";

    }
}
    else
        $oke=false;




    if($connection->connect_errno!=0 )
    {
        echo "Error:".$connection->connect_errno;
    }


    if($oke)
    {
        $login = $_POST['login'];
        $login =htmlspecialchars($_POST['login']);
        $mail = $_POST['mail'];
        $mail =  htmlentities($mail, ENT_QUOTES, "UTF-8");
        $sol = uniqid();
        $phash =sha1(sha1($password.$sol).$sol);
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $password = htmlentities($phash, ENT_QUOTES, "UTF-8");
        $sol= htmlentities($sol, ENT_QUOTES, "UTF-8");
        $password = addslashes($password);
        $q3 = mysqli_query($connection,"call rejestracja('$login','$password','$sol','0','User','$mail')");
        if(!$q3)
        {
            $error = mysqli_error($connection);
        }
        else
        {
            $error = "Rejestracja zakończona powodzeniem";
        }
        $connection->close();
    }

}
catch(IException $ex)
{
    echo $ex.getMessage();
}

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
            Rejestracja
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
            <span class="bigtitle">Rejestracja</span>
            
            <div class="dottedline"></div>
            
             <form action="zarejestrujsie.php" method = "post">
                Login: <br/><input type="text" name="login" onblur="checkInDatabase(this.value);chcekLogin(this.value,20,5)" placeholder="login" 
                <?php  if(isset($_POST['login'])) { echo 'value = "'.$_POST['login'].'"';} ?> /><br/>
                <div id='div1'> </div>  
                <div name='error2' id='error2'></div>
                Hasło: <br/><input type="password" id="pass1" onblur="chcekPass(this.value,50,8)" name="password"/><br/>
                <div id='div2'> </div>  
                Potwierdź hasło: <br/><input type="password" id="pass2" onblur='passValidation(this.value,document.getElementById("pass1").value)' name="password2"/><br/><br/>
                <div id='div3'> </div>  
                E-mail: <br/><input type="email"  name="mail" <?php  if(isset($_POST['mail'])) { echo 'value = "'.$_POST['mail'].'"';} ?> /><br/>
                 Zaakceptuj 
                 <button id="myBtn" type="button" >regulamin </button>


<div id="myModal" class="modal">

  <div class="modal-content">
    <span class="close">&times;</span>
    <p>REGULAMIN USŁUGI:<br>
    Wyrażam zgodę na przetwarzanie swoich danych osobowych w celach marketingowych przez Sephora 
Polska zgodnie z ustawą z dnia 29 sierpnia 1997 r. o ochronie danych osobowych (tekst jednolity: Dz. 
U. 2002 r. Nr 101 poz. 926 z późn. zm.) oraz na otrzymywanie od Steam 2.0 informacji handlowych drogą elektroniczną zgodnie z ustawą z dnia 18.07.2002 r. (Dz.U. nr 144, poz.1204 z późn. zm.) 
o świadczeniu usług drogą elektroniczną.
    </p>
  </div>

</div>

                 <input type=checkbox id="regulaminn"  name="regulamin" /><br><br>
                 <div id='div4'> <?php  if(isset($onregulamin) && isset($_POST['login'])) {echo $onregulamin;}?> </div>  
                <input type="submit" value="Zarejestruj się"/> 
<?php
            echo "</br>".$error;

?>
                <div id='error10'><?php if(!empty($registryFailed))echo $registryFailed; ?></div>
            </form>  
        <br/>
    </form>
        </div>  
        
        <div id="footer">
            Poznaj nową platformę zarządzania swoimi grami. &copy; Wszelkie prawa zastrzeżone
        </div>

</body>

<script> //modal
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<script>
function chcekLogin(value, valuemax, valuemin)
{
    var checker=0;
    var len =value.length;
    if(len>valuemax)
    {
        checker++;
        document.getElementById("div1").innerHTML="login może mieć co najwyżej 20 znaków";
    }

    if(len<valuemin)
    {
        checker++;
        document.getElementById("div1").innerHTML="login musi mieć co najmniej 5 znaków";
    }
    if(checker==0)
        document.getElementById("div1").innerHTML="";
}   

function chcekPass(value, valuemax, valuemin)
{
    var checker=0
    var len =value.length;
    document.getElementById("div2").innerHTML=len;
    if(len>valuemax)
    {
        checker++;
        document.getElementById("div2").innerHTML="Hasło może mieć najwyżej 50 znaków";
    }

    if(len<valuemin)
    {
        checker++;
        document.getElementById("div2").innerHTML="Hasło musi mieć co najmniej 8 znaków";
    }
    if(checker==0)
        document.getElementById("div2").innerHTML="";
}

function passValidation(value1, value2)
{
    if(value1 != value2)
        document.getElementById("div3").innerHTML="Hasło się nie zgadzają";
    else
        document.getElementById("div3").innerHTML="";
}
</script>
<?php
require 'database.php';
?>