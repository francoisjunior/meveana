<?php
	session_start();

	include('dbconfig.php');

	$valorPedido = 0;
	$idPedido    = 0;

	//verifica se existem itens no pedido
	if (count($_SESSION['itens']) < 1) {
		header('Location: ./?p=53&msg=e7');
		exit;
	}

	//varrer a sessão para calcular o valor total do pedido
	foreach ($_SESSION['itens'] as $row) {
		$valorPedido += $row['precoProduto'] * $row['qtdeProduto'];
	}

	//Query de Inserção
	$queryPedido = 'INSERT INTO pedidos (id_cliente, valor_itens, taxa_entrega) 
					VALUES (:id_cliente, :valor_itens, :taxa_entrega)';
	$queryItens  = 'INSERT INTO pedidos_itens (id_pedido, id_produto, qtde, preco) 
					VALUES (:id_pedido, :id_produto, :qtde, :preco)';

	$conn->beginTransaction();
 
    try {    	
		$stmt = $conn->prepare($queryPedido);
		$stmt->bindValue(':id_cliente',   $_SESSION['idCliente']);
		$stmt->bindValue(':valor_itens',  $valorPedido);
		$stmt->bindValue(':taxa_entrega', 0);
        $stmt->execute();

        $sql = 'SELECT max(id) as id FROM pedidos';
        foreach ($conn->query($sql) as $row) {
          $idPedido = $row['id'];
        }

        $stmt = $conn->prepare($queryItens);
        foreach ($_SESSION['itens'] as $row) {
			$stmt->bindValue(':id_pedido',    $idPedido);
			$stmt->bindValue(':id_produto',   $row['idProduto']);
			$stmt->bindValue(':qtde',         $row['qtdeProduto']);
			$stmt->bindValue(':preco',        $row['precoProduto']);
			$stmt->execute();
	    }
        
        $conn->commit();

        session_destroy();

        header('Location: ./?p=5&msg=s1');
    }
    catch(Exception $e) {
        $conn->rollback();
        session_destroy();
        header('Location: ./?p=5&msg=e6&msgext='.$e);
    }

?>