<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id_conta		=	$_GET['id_conta'];
$condicao		=	"id_conta = $id_conta";

$linha_afetada	=	mysql_num_rows(mysql_query("SELECT * FROM PEDIDO WHERE CONTA_id_conta=$id_conta"));
if($linha_afetada){
	echo "CONTA POSSUI PEDIDOS, IMPOSSIVEL EXCLUIR<br>";
	echo "<a href='../consulta/contas.php'>Voltar</a> ";

	}else{
	$sucesso	=	exclusaobd("conta",$condicao);
}



if(isset($sucesso)){
	header("location: ../consulta/contas.php ");
	}else{
	
}

?>