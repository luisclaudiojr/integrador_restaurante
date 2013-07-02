<?php
$id_conta	=	$_GET['id_conta'];
$nro_mesa	=	$_GET['mesa'];
include "../conexao.php";
//status P = Pendente  - E = Entregue
$query			=	 mysql_query("Select id_pedido,data_pedido,status_pedido,entrega_pedido,qtd,nome_item,descricao_pedido from pedido INNER JOIN ITEM ON(pedido.ITEM_id_item=item.id_item) where CONTA_id_conta='$id_conta'");
//VERIFICA SE HÁ REGISTROS
$linhas	=	mysql_num_rows($query);
?>
<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	


		<div id='menu' class="fe_menu_index">
			<ul>
			
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_contas.php"; ?>
				<li><a style="background:rgb(133,133,133);" class="desabilitar_link" data-titulo="pedido" "><i class="incluir"></i>Pedidos da Mesa <?php echo $nro_mesa; ?></a></li>
			<ul>
		</div>

	
	<div class="area_de_tabelas">
	<?php 
	//SE HOUVER ELE TRAZ A CONSULTA
	if($linhas){ ?>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width: 46px;">Pedido</th>
			<th style="width: 31px;">Qtd.</th>
			<th>Item</th>
			<th>Descrição</th>
			<th style="width: 112px;">Data</th>
			<th style="width: 112px;">Entrega</th>
			<th style="width: 90px;">Status</th>
			<th style="width: 51px;">Opções</th>
		</tr>
	</thead>
<?php		

$cont			=	0;

while($dados 	= 	 mysql_fetch_array($query))
{
	$cont++;
	$id_pedido				=	$dados['id_pedido'];
	$nome_item				=	$dados['nome_item'];
	$data_pedido			=	$dados['data_pedido'];
	$descricao	     		=	$dados['descricao_pedido'];
	$status					=	$dados['status_pedido'];
	$entrega_pedido			=	$dados['entrega_pedido'];
	$qtd					=	$dados['qtd'];
	$data_pedido			=	date("d/m/Y H:i", strtotime($data_pedido));
	$entrega_pedido			=	date("d/m/Y H:i", strtotime($entrega_pedido));
	if($status == 'P'){
		$entrega_pedido	 =	"Pendente";
		$status			 =	'Pendente';
	}else{
		$status			 =	'Entregue';
	}
	echo "
		<tr>
			<td>$id_pedido</td>
			<td>$qtd</td>
			<td>$nome_item</td>
			<td>$descricao</td>
			<td>$data_pedido</td>
			<td>$entrega_pedido</td>
			<td>$status "; if ($status=='Pendente'){echo "<a href='../alteracao/alt_pos_pedido.php?id_pedido=$id_pedido&mesa=$nro_mesa&conta=$id_conta'><i class='entrega'></i></a>";} echo" </td>
			<td>
			<a href='../exclusao/del_pedido.php?id_pedido=$id_pedido&id_conta=$id_conta&mesa=$nro_mesa'><i class='excluir'></i></a></td>			
		</tr>";
		
}
?>								
	</table>
	<?php }else{
		echo "<p class='sem_registros'>NÃO HÁ NENHUM PEDIDO PARA ESSA CONTA</p>";
	}?>
	</div>
	
	<?php $href = "/cadastro/cad_pedido.php?id_conta=$id_conta"; include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_incluir.php"; ?>
	
</html>

