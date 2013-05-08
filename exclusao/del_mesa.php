<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id			=	$_GET['id'];
$condicao	=	"id_mesa = $id";
$sucesso	=	exclusaobd("mesa",$condicao);



if($sucesso){
	header("location: ../consulta/mesas.php ");
}else{
	
}

?>