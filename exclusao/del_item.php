<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id			=	$_GET['id'];
$condicao	=	"id_item = $id";
$sucesso	=	exclusaobd("item",$condicao);



if($sucesso){
	header("location: ../consulta/itens.php ");
}else{
	
}

?>