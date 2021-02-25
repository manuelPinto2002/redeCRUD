<?php
function testeSessao(){
session_start();

if (isset($_SESSION["sessionmaxtime"])&&(time()-$_SESSION["sessionmaxtime"])>60*60) {
	session_destroy();
	echo "A sessão expirou.Aguarde...";
	header("Refresh:5;url=login.php");
}
else
	if ($_SESSION["login"]==1 && $_SESSION["browser"]==$_SERVER["HTTP_USER_AGENT"]) {
		return true;
	
	}
	
	else{
		echo "A sessão não está ativa.<br>";
		echo "<a href='login.php'>Pagina de Login";
	}
	return false;

}