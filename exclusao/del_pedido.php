<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id			=	$_GET['id_pedido'];
$id_conta	=	$_GET['id_conta'];
$mesa		=	$_GET['mesa'];

$condicao	=	"id_pedido = $id";
//EXCLUI PEDIDO
$sucesso	=	exclusaobd("pedido",$condicao);

if($sucesso){
	header("location: ../consulta/pedidos.php?id_conta=$id_conta&mesa=$mesa");
}else{
	
}

?>