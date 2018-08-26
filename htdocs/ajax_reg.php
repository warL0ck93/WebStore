<?php

require 'database.php';

            $connection = @new mysqli($host, $db_user, $db_password, $db_name);
$response='error';
if(isset($_POST['login']) && !empty($_POST['login']))
{
	$response='true';
    $login=$_POST['login'];

    $query=@$connection->query(sprintf("SELECT nazwa_uzytkownika FROM Uzytkownicy WHERE nazwa_uzytkownika='$login'",mysqli_real_escape_string($login)));
	if(!$query)
	{
		echo mysqli_error($connection);
		exit();
	}

    if(mysqli_num_rows($query)!=0)
    {
        $response='false';
    }
}

echo $response;

mysqli_close($connection);
?>