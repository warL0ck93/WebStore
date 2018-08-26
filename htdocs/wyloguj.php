<?php
	require 'database.php';

	$connection = @new mysqli($host, $db_user, $db_password, $db_name);

	@$connection->query(sprintf("DELETE FROM Sesja WHERE login='%s'", mysqli_real_escape_string($connection,$_COOKIE['login'])));
	setcookie("id",null,time()-1);
	unset($_COOKIE['id']);

	setcookie("login",null,time()-1);
	unset($_COOKIE['login']);

	setcookie("ip",null,time()-1);
	unset($_COOKIE['ip']);

	setcookie('token',null,time()-1);
	unset($_COOKIE['token']);
    header('Location: index.php');
?>