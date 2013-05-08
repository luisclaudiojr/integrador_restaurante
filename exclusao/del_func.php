<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id			=	$_GET['id'];
$condicao	=	"id_funcionario = $id";
$sucesso	=	exclusaobd("funcionario",$condicao);



if($sucesso){
	header("location: ../consulta/funcionarios.php ");
}else{
	
}

?>