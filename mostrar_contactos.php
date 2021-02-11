<?php
require_once 'ligacaoBD.php';//verifica a ligacao BD
require_once 'testaSessao.php'//verifica se sessao ainda esta ativa ou nao

if (testaSessao()) {
	if ($con=LigaBD()) {
		//verifica se utlizador presionou algum link para apagar um registo e pagar o registo com esse id
		if (isset($_GET["id"])) {
			$stm=$con->prepare("delete from contactos where id_contactos=?");
			$stm->bind_param('i',$_GET['id']);
			$stm->execute();
		}
		//apresenta todos os registos da tabela contactos -consulda dados
		$query=$con->query("select * from contactos");
		echo "<h1>PAINEL DE CONTACTOS - <a href='from_contactos.php'>Adicionar contactos </a></h1>";
		echo "<table><tr><th>Primeiro Nome</th>
			<th>Ultimo Nome</th>
			<th>Editar</th>
			<th>Eliminar</th></tr>";
			while ($resultados=$query->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$resuldados['primeiro_nome']."</td><td>".$resuldados['ultimo_nome']."</td>"."<td><a href='from_contactos.php?id=".$resuldados['id_contacto']."'>Editar</a></td>"."<td><a href='mostrar_contactos.php?id=".$resuldados['id_contacto']."'>Eliminar</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			$con->close();
	}
}