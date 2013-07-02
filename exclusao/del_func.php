<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>

<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id			=	$_GET['id'];
$condicao	=	"id_funcionario = $id";
$sucesso	=	exclusaobd("funcionario",$condicao);

$query			=	 mysql_query("Select * from funcionario");

while($dados 	= 	 mysql_fetch_array($query))
{
	$nome					=	$dados['nome_funcionario'];
}
?>


	

		


<?php
if($sucesso){
	header("location: ../consulta/funcionarios.php?excluido=true");
}else{
	header("location: ../consulta/funcionarios.php?excluido=false ");
}

?>