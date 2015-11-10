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
        $id_empresa = $_POST['idEmpresaEntregador'];
        $nome       = $_POST['nomeEntregador'];
        $cpf        = $_POST['cpfEntregador'];
        $rg         = $_POST['rgEntregador'];
        $telefone   = $_POST['telefoneEntregador'];
    }

	//tratamento dos dados recebidos
	$telefone = str_replace(array('(', ')', '-'), '', $telefone);
	$cpf      = str_replace(array('.', '-'), '', $cpf);
	

	//Query de Inserção
	$queryInsert = 'INSERT INTO entregadores (id_empresa, nome, cpf, rg, telefone) 
					VALUES (:id_empresa, :nome, :cpf, :rg, :telefone)';
	//Query de Atualização
	$queryUpdate = 'UPDATE entregadores SET id_empresa = :id_empresa, nome = :nome, 
					cpf = :cpf, rg = :rg, telefone = :telefone WHERE id = :id';
	//Query de Deleção
	$queryDelete = 'DELETE FROM entregadores WHERE id = :id';

	$conn->beginTransaction();
 
    try {
    	switch ($operacao) {
    		case 1:
    			$stmt = $conn->prepare($queryInsert);
    			$stmt->bindValue(':id_empresa', $id_empresa);  			
                $stmt->bindValue(':nome',       $nome);
                $stmt->bindValue(':cpf',        $cpf);
                $stmt->bindValue(':rg',         $rg);
                $stmt->bindValue(':telefone',   $telefone);
    			break;
    		case 2:
    			$stmt = $conn->prepare($queryUpdate);
    			$stmt->bindValue(':id',         $id);
    			$stmt->bindValue(':id_empresa', $id_empresa);            
                $stmt->bindValue(':nome',       $nome);
                $stmt->bindValue(':cpf',        $cpf);
                $stmt->bindValue(':rg',         $rg);
                $stmt->bindValue(':telefone',   $telefone);
    			break;
    		case 3:
    			$stmt = $conn->prepare($queryDelete);
    			$stmt->bindValue(':id',         $id);
    			break;
    	}

        $stmt->execute();
        $conn->commit();
        header('Location: ' . $url . '?p=3&msg=s' . $operacao);

    }
    catch(Exception $e) {
        $conn->rollback();
        header('Location: ' . $url . '?p=3&msg=e' . $operacao);
    }
	
?>