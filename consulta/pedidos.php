<?php
$id_conta	=	$_GET['id_conta'];
$nro_mesa	=	$_GET['mesa'];
?>
<html>
	
	<?php /* <head> ============== */ include "/includes/head.php"; ?>
	
<h1>Pedidos da Mesa <?php echo $nro_mesa; ?> </h1>
	<table>
		<tr>
			<th>Nro Pedido</th>
			<th>Item</th>
			<th>Quantidade</th>
			<th>Descrição</th>
			<th>Data Pedido</th>
			<th>Data Entrega</th>
			<th>Status</th>
			<th>Alterar Posição</th>
			<th>Excluir</th>
			
		</tr>
<?php		
include "../conexao.php";
$cont			=	0;
//status P = Pendente  - E = Entregue
$query			=	 mysql_query("Select id_pedido,data_pedido,status_pedido,entrega_pedido,qtd,nome_item,descricao_pedido from pedido INNER JOIN ITEM ON(pedido.ITEM_id_item=item.id_item) where CONTA_id_conta='$id_conta'");

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
		
			<td>$nome_item</td>
			<td>$qtd</td>
			<td>$descricao</td>
			<td>$data_pedido</td>
			<td>$entrega_pedido</td>
			<td>$status</td>
			<td><a href='../alteracao/alt_pos_pedido.php?id_pedido=$id_pedido&mesa=$nro_mesa&conta=$id_conta'>Alterar Posicao</a></td>
			<td><a href='../exclusao/del_pedido.php?id_pedido=$id_pedido&id_conta=$id_conta&mesa=$nro_mesa'>Excluir</a></td>
			
		</tr>";
		
}
?>								
	<button ><a href="../cadastro/cad_pedido.php?id_conta=<?php echo $id_conta; ?>"> Incluir Pedido</a></button>
	<a href="../index.php">Página Inicial</a>	
	</table>
</html>

