<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id	  	=	$_GET['id_pedido'];
$conta  =	$_GET['conta'];
$mesa   = 	$_GET['mesa'];
$campos=array
		(
			'status_pedido' 	   => 'E',
			'entrega_pedido' => date("Y-m-d H:i:s")
		);
$condicao = "where id_pedido = $id";
$sucesso  = alteracaobd("pedido", $campos, $condicao);
if($sucesso){
	echo "Registro Alterado";
	header("location: ../consulta/pedidos.php?id_conta=$conta&mesa=$mesa ");
}else{
	echo "Erro ao Alterar";
}


?>