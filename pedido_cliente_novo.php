<?php
    session_start();

	include_once('dbconfig.php');
	include_once('funcoes.php');

	//url para redirecionamento (ex.: http://localhost/portfolio/ )
	//$url = "http://" . $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"],0,strpos($_SERVER["REQUEST_URI"],'/',1)+1);
    $url = './';

	$nome       = $_POST['nomeCliente'];
	$telefone   = $_POST['telefoneCliente'];
	$endereco   = $_POST['enderecoCliente'];
	$referencia = $_POST['pontoRefCliente'];
	$nascimento = $_POST['dataNascCliente'];


	//tratamento dos dados recebidos
	$telefone   = str_replace(array('(', ')', '-'), '', $telefone);
	$nascimento = data_br_mysql($nascimento);
	

	//Query de Inserção
	$queryInsert = 'INSERT INTO clientes (nome, telefone, endereco, referencia, nascimento) 
					VALUES (:nome, :telefone, :endereco, :referencia, :nascimento)';
	$conn->beginTransaction();
 
    try {    	
		$stmt = $conn->prepare($queryInsert);
		$stmt->bindValue(':nome',       $nome);
		$stmt->bindValue(':telefone',   $telefone);
		$stmt->bindValue(':endereco',   $endereco);
		$stmt->bindValue(':referencia', $referencia);
		$stmt->bindValue(':nascimento', $nascimento);
        $stmt->execute();
        $conn->commit();
        
        $sql = ('SELECT id, nome, telefone FROM clientes WHERE telefone = ' . $telefone);
        foreach ($conn->query($sql) as $row) {
          $_SESSION['idCliente']   = $row['id'];
          $_SESSION['nomeCliente'] = $row['nome'];  
          $_SESSION['itens']       = array();
        }
        
        header('Location: ' . $url . '?p=53');
    }
    catch(Exception $e) {
        $conn->rollback();
        session_destroy();
        header('Location: ' . $url . '?p=5&msg=e6');
    }
	
?>