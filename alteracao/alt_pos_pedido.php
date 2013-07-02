<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";
$cont=0;
$id	  	=	$_GET['id_pedido'];
if(isset($_GET['pendentes'])){
	$cont++;
}else{
$cont=0;
$conta  =	$_GET['conta'];
$mesa   = 	$_GET['mesa'];
}
$campos=array
		(
			'status_pedido' 	   => 'E',
			'entrega_pedido' => date("Y-m-d H:i:s")
		);
$condicao = "where id_pedido = $id";
$sucesso  = alteracaobd("pedido", $campos, $condicao);
if($sucesso){
	if($cont!=0){
		header("location: consulta/pedidos_pendentes.php?alterado=true");
	}else{
		header("location: ../consulta/pedidos.php?id_conta=$conta&mesa=$mesa&alterado=true ");
	}
}

?>