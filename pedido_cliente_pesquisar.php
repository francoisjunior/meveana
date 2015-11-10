<?php
  //iniciar a sessão
  session_start();

  include_once('dbconfig.php');

  $url       = './';
  $pesquisar = '';

  if (isset($_POST['pesquisar']) && !empty($_POST['pesquisar'])) {
    $pesquisar = $_POST['pesquisar'];
  } else {
    session_destroy();
    header('Location: ' . $url . '?p=5');
  }

  $res = $conn->query('SELECT count(*) FROM clientes WHERE telefone = ' . $pesquisar);

  if ($res->fetchColumn() > 0) {
    $sql = 'SELECT id, nome FROM clientes WHERE telefone = ' . $pesquisar;
    foreach ($conn->query($sql) as $row) {
      $_SESSION['idCliente']   = $row['id'];
      $_SESSION['nomeCliente'] = $row['nome'];  
      $_SESSION['itens']       = array();
    }
    header('Location: ' . $url . '?p=53');
  } else {
    $_SESSION['telefoneCliente'] = $pesquisar;
    header('Location: ' . $url . '?p=52');
  }
  
?>