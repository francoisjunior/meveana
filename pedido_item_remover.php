<?php
	session_start();

	if (isset($_POST['id'])) {
		
		unset($_SESSION['itens'][intval($_POST['id']) - 1]);
		
		header('Location: ./?p=53');

	} else {
		header('Location: ./?p=5');
	}
?>