<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>

<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id_conta		=	$_GET['id_conta'];
$condicao		=	"id_conta = $id_conta";

$query			=   mysql_query("Select * from conta where id_conta=$id_conta");
$mesa			=   mysql_fetch_array($query);

//captura a mesa para alterar o status dela para LIBERADA
$id_mesa		=   $mesa['MESA_id_mesa'];
$linha_afetada	=	mysql_num_rows(mysql_query("SELECT * FROM PEDIDO WHERE CONTA_id_conta=$id_conta"));

//verifica se existe a conta
if($linha_afetada){
	
	}else{
		$campos2=array
			(
				'status' 	   				 => 'L'								  
			);
	//FAZ A ALTERACAO DO STATUS
			$where = "where id_mesa=$id_mesa";
			$alt_pos_mesa  = alteracaobd("mesa",$campos2,$where);
			//EXCLUI A CONTA
			$sucesso	=	exclusaobd("conta",$condicao);
}

if(isset($sucesso)){
	header("location: ../consulta/contas.php?excluido=true");
	}else{
	header("location: ../consulta/contas.php?excluido=false ");
}





?>