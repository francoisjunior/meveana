<?php
	include_once('dbconfig.php');

	//url para redirecionamento (ex.: http://localhost/portfolio/ )
	//$url = "http://" . $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"],0,strpos($_SERVER["REQUEST_URI"],'/',1)+1);
    $url = './';

	//pegar os valores
	$statusPedido = $_POST['statusPedido'];
	$id           = intval($_POST['id']);

    //Query de Atualização
    $queryUpdate  = 'UPDATE pedidos SET ';
    $queryUpdate .= 'status = :status';

    switch ($statusPedido) {
        case 'Em trânsito':
            $idEntregador = intval($_POST['idEntregador']);
            $queryUpdate .= ', id_entregador = :id_entregador';
            break;
        case 'Entregue':
            $valorPago = $_POST['valorPago'];
            $queryUpdate .= ', valor_pago = :valor_pago';
            break;
    }

    $queryUpdate .= ' WHERE id = :id';

	$conn->beginTransaction();
 
    try {
    	$stmt = $conn->prepare($queryUpdate);
        $stmt->bindValue(':id',     $id);
        $stmt->bindValue(':status', $statusPedido);
        switch ($statusPedido) {
            case 'Em trânsito':
                $stmt->bindValue(':id_entregador', $idEntregador);
                break;
            case 'Entregue':
                $stmt->bindValue(':valor_pago',    $valorPago);
                break;
        }

        $stmt->execute();
        $conn->commit();
        header('Location: ' . $url . '?p=5&msg=s2');

    }
    catch(Exception $e) {
        $conn->rollback();
        header('Location: ' . $url . '?p=5&msg=e2');
    }
	
?>