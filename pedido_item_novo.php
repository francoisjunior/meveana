<?php
	session_start();

	if (isset($_POST['idProduto']) && isset($_POST['qtdeProduto'])) {
		
		include('dbconfig.php');

		$consulta = 'SELECT id, nome, tamanho, preco FROM produtos WHERE id = ' . intval($_POST['idProduto']);
		foreach ($conn->query($consulta) as $row) {
			$_SESSION['itens'][] = array('idProduto' => $row['id'], 
										 'nomeProduto' => $row['nome'] . ' (' . $row['tamanho'] . ')',
										 'precoProduto' => $row['preco'],
										 'qtdeProduto' => $_POST['qtdeProduto']);
		}
		header('Location: ./?p=53');

	} else {
		header('Location: ./?p=5');
	}
?>