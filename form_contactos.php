<!DOCTYPE html>
<html>
<style>
	.erro{
		color:red;
	}
</style>

<body>
<h1><b>Formulário de contacto</b></h1>
<?php
	require_once'ligacaoBD.php';
	require_once'testasessao.php';

	if(isset($_GET["id"])){
	       $operacao= "update";

		$con=LigaBD();
		$stm=$con->prepare("select * from contactos where id_contacto=?");
		$stm-> bind_param("i", $_GET["id"]);
		$stm->execute();
		$res=$stm->get_result();
		$resultados=$res->fetch_assoc();
		$con->close();
	}else
	$operacao="insert";

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
		require ("validacao.php");
		$validacao=ValidarForm();
	}
?>


<form action="<?php ($operacao=="update")? $_SERVER["PHP_SELF"]."?id=".$_GET["id"]:$_SERVER["PHP_SELF"];?>" method="post">
    <b>Primeiro Nome:</b><?php
    if($_POST && in_array("primeiro_nome", $validacao))
        echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
        ?> <input name="primeiro_nome" size="45" type="text" value="<?php

        if($_POST){
            if(!empty($_POST["primeiro_nome"]))
            echo htmlentities($_POST["primeiro_nome"],ENT_QUOTES);
        } else if ($operacao=="update")
        echo $resultados["primeiro_nome"];
        ?>"><br/><br><b>Último Nome: </b> <?php
        if($_POST && in_array("ultimo_nome", $validacao))
        echo "<span class=\"erro\">(Preenchimento obrigatório)</span>";
        ?> <input name="ultimo_nome"size="45" type="text" value="<?php
        if($_POST){
            if(!empty($_POST["ultimo_nome"]))
            echo htmlentities($_POST["ultimo_nome"],ENT_QUOTES);
        } else if ($operacao=="update")
        echo $resultados["ultimo_nome"];
        ?>"><br/><br/>

<input name="submit" type="submit" value="Submeter contacto">
        <input type="reset" value="Limpar"><br>
        </form>


<?php
		if ($_POST && count($validacao)==0){

			$con=ligaBD();
			if($operacao=="insert"){

				$stm=$con->prepare("insert into contactos values(0,?,?)");

			  $stm->bind_param("ss", $_POST["primeiro_nome"], $_POST["ultimo_nome"]);

				if ($stm->execute()){
					header("Location:mostrar_contactos.php");
				}else{
					echo "Ocorreu um erro a inserir o registo.";
					header("Refresh:5; url=mostrar_contactos
					.php");
				}

				$stm->close();
			}
				if($operacao=="update"){
					$stm=$con->prepare("update contactos set primeiro_nome=?, ultimo_nome=? where id_contacto=? ");

					$stm->bind_param("ssi", $_POST["primeiro_nome"],$_POST["ultimo_nome"], $_GET["id"]);
					if($stm->execute()){
						header("Location:mostrar_contactos.php");
					}else{
						echo "Ocorreu um erro a atualizar o registo.";
						header("Refresh:5; url=mostrar_contactos
					.php");
					}
					$stm->close();
				}
				$con->close();
		}
		?>
</body>
</html>