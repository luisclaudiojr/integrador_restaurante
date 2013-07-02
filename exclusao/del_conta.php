<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>

<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id_conta		=	$_GET['id_conta'];
$condicao		=	"id_conta = $id_conta";

$linha_afetada	=	mysql_num_rows(mysql_query("SELECT * FROM PEDIDO WHERE CONTA_id_conta=$id_conta"));
if($linha_afetada){?>


		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_3" data-titulo="contas" ><i class="contas"></i>Contas em Aberto</a></li>
				<li><a class="desabilitar_link fundo_7" data-titulo="conta" ><i class="contas"></i>Excluir Conta número <?php echo $id_conta; ?></a></li>
			<ul>
		</div>

		<div class="area_de_tabelas">
			<div class="msg_erro">CONTA POSSUI PEDIDOS, IMPOSSIVEL EXCLUIR</div>
		</div>
	
		<button class="fundo_8" ><a href="/consulta/contas.php"><i class='cancelar'></i>Cancelar</a></button>
	

	<?php }else{
	$sucesso	=	exclusaobd("conta",$condicao);
}



if(isset($sucesso)){
	header("location: ../consulta/contas.php ");
	}else{
	
}

?>