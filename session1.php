<?php
require_once 'ligacaoBD.php';
//Verifica a conexao a BD
session_start();
$_SESSION["sessionmaxtime"]=time();
$con=LigaBD();

if($stm=$con->prepare("select * from utilizadores where utilizador=? and password=?")){

	$stm->bind_param("ss", $_POST["utilizador"], $_POST["password"]);
	$stm->execute();
	$stm->store_result();

	if ($stm->num_rows>0) {
		$_SESSION["login"]=1;
		$_SESSION["browser"]=$_SERVER["HTTP_USER_AGENT"];
		header("Location:mostrar_contactos.php");
	}
	else{
		echo "Os dados não são válidos. Aguarde...";
		header("Refresh: 5; url=login.php");
	}
}
