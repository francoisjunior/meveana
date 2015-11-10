<?php
	include_once('dbconfig.php');
	include_once('funcoes.php');

	//url para redirecionamento (ex.: http://localhost/portfolio/ )
	//$url = "http://" . $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"],0,strpos($_SERVER["REQUEST_URI"],'/',1)+1);
    $url = './';

	//pegar os valores
	$operacao = intval($_POST['op']);
	$id       = intval($_POST['id']);

    if ($operacao == 1 || $operacao == 2) {
    	$nome      = $_POST['nomeProduto'];
    	$descricao = $_POST['descricaoProduto'];
    	$tamanho   = $_POST['tamanhoProduto'];
    	$preco     = $_POST['precoProduto'];
    }

	//Query de Inserção
	$queryInsert = 'INSERT INTO produtos (nome, descricao, tamanho, preco) 
					VALUES (:nome, :descricao, :tamanho, :preco)';
	//Query de Atualização
	$queryUpdate = 'UPDATE produtos SET nome = :nome, descricao = :descricao, 
					tamanho = :tamanho, preco = :preco WHERE id = :id';
	//Query de Deleção
	$queryDelete = 'DELETE FROM produtos WHERE id = :id';

	$conn->beginTransaction();
 
    try {
    	switch ($operacao) {
    		case 1:
    			$stmt = $conn->prepare($queryInsert);
    			$stmt->bindValue(':nome',      $nome);
    			$stmt->bindValue(':descricao', $descricao);
    			$stmt->bindValue(':tamanho',   $tamanho);
    			$stmt->bindValue(':preco',     $preco);
    			break;
    		case 2:
    			$stmt = $conn->prepare($queryUpdate);
    			$stmt->bindValue(':id',        $id);
    			$stmt->bindValue(':nome',      $nome);
    			$stmt->bindValue(':descricao', $descricao);
    			$stmt->bindValue(':tamanho',   $tamanho);
    			$stmt->bindValue(':preco',     $preco);
    			break;
    		case 3:
    			$stmt = $conn->prepare($queryDelete);
    			$stmt->bindValue(':id',        $id);
    			break;
    	}

        $stmt->execute();
        $conn->commit();
        header('Location: ' . $url . '?p=4&msg=s' . $operacao);

    }
    catch(Exception $e) {
        $conn->rollback();
        header('Location: ' . $url . '?p=4&msg=e' . $operacao);
    }
	
?>