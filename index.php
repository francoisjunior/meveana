<?php
	include_once('funcoes.php');
	
	//iniciar variáveis
	$menu     = 0; //marcação do menu
	$pagina   = 0; //página a ser exibida, concatenada com a operação
	$operacao = 0; //operação a ser realizada (adição, edição ou exclusão)
	$id       = 0; //código do registro a ser editado ou excluído

	/*
		verificar se foi informada a página e se é do tipo numérico
		::: R E G R A :::
		Primeiro dígito corresponde à página. Na ausência do parâmetro ou valor fora da faixa, considera-se a index.
			1 = Cliente
			2 = Terceirizada
			3 = Entregador
			4 = Produto
			5 = Pedido
		
		Segundo dígito corresponde à operação. Na ausência desse ou valor fora da faixa, considera-se a página de listagem.
			1 = Cadastrar
			2 = Editar
			3 = Excluir
	*/
	if (isset($_GET['p']) && is_numeric($_GET['p'])) {
		//preparar o valor passado
		if (strlen($_GET['p']) == 1) {
			$val1 = intval($_GET['p']);
			$val2 = 0;
		} else {
			$val1 = intval(substr($_GET['p'] , 0, 1));
			$val2 = intval(substr($_GET['p'] , 1, 1));
		}

		//verificar se está na faixa desejada
		if ($val1 >= 1 && $val1 <= 5) {
			$menu   = $val1;
			$pagina = $val1;
		}
		if ($val2 >= 1 && $val2 <= 5) {
			$operacao = $val2;
			$pagina  .= $val2;
		}
	} 
	
	//iniciar a página
	include('html/cabeca.html');
	include('html/menu.html');

	//faz o include da página correspondente
	switch ($pagina) {
		case 1:
			include('html/cliente.html');
			break;
		case 2:
			include('html/terceirizada.html');
			break;
		case 3:
			include('html/entregador.html');
			break;
		case 4:
			include('html/produto.html');
			break;
		case 5:
			include('html/pedido.html');
			break;
		case 11:
			include('html/cliente_form.html');
			break;
		case 12:
			include('html/cliente_form.html');
			break;
		case 21:
			include('html/terceirizada_form.html');
			break;
		case 22:
			include('html/terceirizada_form.html');
			break;
		case 31:
			include('html/entregador_form.html');
			break;
		case 32:
			include('html/entregador_form.html');
			break;
		case 41:
			include('html/produto_form.html');
			break;
		case 42:
			include('html/produto_form.html');
			break;
		case 51:
			include('html/pedido_cliente_pesquisar.html');
			break;
		case 52:
			include('html/pedido_cliente_form.html');
			break;
		case 53:
			include('html/pedido_cliente_itens.html');
			break;
		case 54:
			include('html/pedido_visualizar.html');
			break;
		case 55:
			include('html/pedido_atualizar.html');
			break;
	}
	
	//fechar a página
	include('html/rodape.html');
?>