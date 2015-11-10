<?php
	$dsn = 'mysql:host=localhost;dbname=meveana';
	$user = 'root';
	$password = 'out1903';

	//realizar conexão com o banco de dados
    try {
        $conn = new PDO($dsn, $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>