<?php
function ligaBD(){
	$con=new mysqli("localhost", "root", "mysql", "contactos");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados" . $con->connect_error;
		exit;
	}
	return $con;
}