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
    	$nome     = $_POST['nomeEmpresa'];
    	$cnpj     = $_POST['cnpjEmpresa'];
        $endereco = $_POST['enderecoEmpresa'];
        $telefone = $_POST['telefoneEmpresa'];
        $email    = $_POST['emailEmpresa'];
    }

	//tratamento dos dados recebidos
	$telefone = str_replace(array('(', ')', '-'), '', $telefone);
	$cnpj     = str_replace(array('.', '-', '/'), '', $cnpj);
	

	//Query de Inserção
	$queryInsert = 'INSERT INTO empresas (nome, cnpj, endereco, telefone, email) 
					VALUES (:nome, :cnpj, :endereco, :telefone, :email)';
	//Query de Atualização
	$queryUpdate = 'UPDATE empresas SET nome = :nome, cnpj = :cnpj, endereco = :endereco, 
					telefone = :telefone, email = :email WHERE id = :id';
	//Query de Deleção
	$queryDelete = 'DELETE FROM empresas WHERE id = :id';

	$conn->beginTransaction();
 
    try {
    	switch ($operacao) {
    		case 1:
    			$stmt = $conn->prepare($queryInsert);
                $stmt->bindValue(':nome',     $nome);
    			$stmt->bindValue(':cnpj',     $cnpj);
    			$stmt->bindValue(':endereco', $endereco);
                $stmt->bindValue(':telefone', $telefone);
    			$stmt->bindValue(':email',    $email);  			
    			break;
    		case 2:
    			$stmt = $conn->prepare($queryUpdate);
    			$stmt->bindValue(':id',       $id);
    			$stmt->bindValue(':nome',     $nome);
                $stmt->bindValue(':cnpj',     $cnpj);
                $stmt->bindValue(':endereco', $endereco);
                $stmt->bindValue(':telefone', $telefone);
                $stmt->bindValue(':email',    $email); 
    			break;
    		case 3:
    			$stmt = $conn->prepare($queryDelete);
    			$stmt->bindValue(':id',       $id);
    			break;
    	}

        $stmt->execute();
        $conn->commit();
        header('Location: ' . $url . '?p=2&msg=s' . $operacao);

    }
    catch(Exception $e) {
        $conn->rollback();
        header('Location: ' . $url . '?p=2&msg=e' . $operacao);
    }
	
?>