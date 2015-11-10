<?php
	function imprime_msg($codigo){
		//definir mensagens
		$mensagens = array('s1' => 'Registro inserido com sucesso!',
						   's2' => 'Registro atualizado com sucesso!',
						   's3' => 'Registro deletado com sucesso!',
						   'e1' => 'Erro ao inserir o registro.',
						   'e2' => 'Erro ao atualizar o registro.',
						   'e3' => 'Erro ao deletar o registro.',
						   'e4' => 'Operação inválida.',
						   'e5' => 'Código inválido.',
						   'e6' => 'Erro ao cadastrar o cliente.');

		$retorno = '';
		$classe  = '';
		
		//Verificar se é para exibir mensagem de erro ou sucesso (esquema de cores)
		if (substr($codigo,0,1) == 's') {
			$classe = 'alert-success';
		} elseif (substr($codigo,0,1) == 'e') {
			$classe = 'alert-danger';
		}

		//Verifica se o código de erro existe no array. Caso não, nada será exibido.
		if (array_key_exists($codigo, $mensagens)) {
			$retorno  = '<div class="alert ' . $classe . '" role="alert">';
			$retorno .= $mensagens[$codigo];
			$retorno .= '</div>';
		}

		return $retorno;
	}

	function data_br_mysql ($data) {
		if (strpos($data, '/') > 0) {
			$data = implode('-',array_reverse(explode('/',$data)));
		}
		return $data;
	}

	function data_mysql_br ($data) {
		return implode('/',array_reverse(explode('-',$data)));
	}

	function detecta_os () {
		$sistema = 'Não identificável';
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows')) {
			$sistema = 'Windows';
		} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Linux')) {
			$sistema = 'Linux';
		} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Android')) {
			$sistema = 'Android';
		}

		return $sistema;
	}

	function detecta_navegador () {
		$sistema = 'Não identificável';
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
			$sistema = 'Firefox';
		} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
			$sistema = 'Chrome';
		}

		return $sistema;
	}

	function formata_tel ($telefone) {
		return substr($telefone, 0, strlen($telefone)-4) . '-' . substr($telefone, -4);
	}
?>