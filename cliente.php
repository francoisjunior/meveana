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
    	$nome       = $_POST['nomeCliente'];
    	$telefone   = $_POST['telefoneCliente'];
    	$endereco   = $_POST['enderecoCliente'];
    	$referencia = $_POST['pontoRefCliente'];
    	$nascimento = $_POST['dataNascCliente'];
    }

	//tratamento dos dados recebidos
	$telefone   = str_replace(array('(', ')', '-'), '', $telefone);
	$nascimento = data_br_mysql($nascimento);
	

	//Query de Inserção
	$queryInsert = 'INSERT INTO clientes (nome, telefone, endereco, referencia, nascimento) 
					VALUES (:nome, :telefone, :endereco, :referencia, :nascimento)';
	//Query de Atualização
	$queryUpdate = 'UPDATE clientes SET nome = :nome, telefone = :telefone, endereco = :endereco, 
					referencia = :referencia, nascimento = :nascimento WHERE id = :id';
	//Query de Deleção
	$queryDelete = 'DELETE FROM clientes WHERE id = :id';

	$conn->beginTransaction();
 
    try {
    	switch ($operacao) {
    		case 1:
    			$stmt = $conn->prepare($queryInsert);
    			$stmt->bindValue(':nome',       $nome);
    			$stmt->bindValue(':telefone',   $telefone);
    			$stmt->bindValue(':endereco',   $endereco);
    			$stmt->bindValue(':referencia', $referencia);
    			$stmt->bindValue(':nascimento', $nascimento);
    			break;
    		case 2:
    			$stmt = $conn->prepare($queryUpdate);
    			$stmt->bindValue(':id',         $id);
    			$stmt->bindValue(':nome',       $nome);
    			$stmt->bindValue(':telefone',   $telefone);
    			$stmt->bindValue(':endereco',   $endereco);
    			$stmt->bindValue(':referencia', $referencia);
    			$stmt->bindValue(':nascimento', $nascimento);
    			break;
    		case 3:
    			$stmt = $conn->prepare($queryDelete);
    			$stmt->bindValue(':id',         $id);
    			break;
    	}

        $stmt->execute();
        $conn->commit();
        header('Location: ' . $url . '?p=1&msg=s' . $operacao);

    }
    catch(Exception $e) {
        $conn->rollback();
        header('Location: ' . $url . '?p=1&msg=e' . $operacao);
    }
	
?>