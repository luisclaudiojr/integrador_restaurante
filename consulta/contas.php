<?php
	include "../conexao.php";
	$query			=	 mysql_query("Select id_conta,data_entrada,mesa.nro_mesa,nome_funcionario from conta  INNER JOIN mesa ON(conta.MESA_id_mesa=mesa.id_mesa)INNER JOIN funcionario ON(conta.FUNCIONARIO_id_funcionario=funcionario.id_funcionario) where status_conta='A' order by mesa.nro_mesa");
	$ver_conta		=	 mysql_num_rows($query);
	if(!$ver_conta){
		echo "NÃO HÁ NENHUMA CONTA EM ABERTO";
	}else{
?>
<html>
<h1>Contas em Aberto</h1>
	<table>
		<tr>
			<th>Nro</th>
			<th>Nro Mesa</th>
			<th>Entrada</th>
			<th>Funcionario</th>
			<th>Valor Total</th>
			<th>Pedidos</th>
			<th>Alterar</th>
			<th>Excluir</th>
			<th>Encerrar Conta</th>
		</tr>
<?php		
$cont			=	0;
//status A = Aberto  - F = Fechada

	while($dados 	= 	 mysql_fetch_array($query))
	{
		$cont++;
		$id_conta				=	$dados['id_conta'];
		$data_entrada			=	$dados['data_entrada'];
		$nro_mesa				=	$dados['nro_mesa'];
		$nome_func				=	$dados['nome_funcionario'];
		$data_entrada			=	date("d/m/Y h:i", strtotime($data_entrada));

		//faz a leitura dos pedidos para pegar o valor, que será mostrado ao usuario

		$consulta_valor		=	mysql_query("Select qtd,vlr_unitario,nome_item from pedido inner join item ON( pedido.ITEM_id_item=item.id_item) where CONTA_id_conta=$id_conta");
		$ver_pedido			=	mysql_num_rows($consulta_valor);
		$valor_final		=	0;
			while($dados 		= 	 mysql_fetch_array($consulta_valor))
			{
				$qtd				=	$dados['qtd'];
				$vlr_unitario		=	$dados['vlr_unitario'];
				//pega o valor total 
				$valor_total		=	$qtd*$vlr_unitario;
				//vai somando os valores dos itens e suas quantidades!
				$valor_final		=	$valor_total+$valor_final;
				$cont++;
			}

		
		echo "
			<tr>
				<td>$cont</td>
				<td>$nro_mesa</td>
				<td>$data_entrada</td>
				<td>$nome_func</td>
				<td>R$ $valor_final</td>
				<td><a href='../consulta/pedidos.php?id_conta=$id_conta&mesa=$nro_mesa'>PEDIDOS</a></td>
				<td><a href='../alteracao/alt_conta.php?id_conta=$id_conta'>Alterar</a></td>
				<td><a href='../exclusao/del_conta.php?id_conta=$id_conta'>Excluir</a></td>
				<td><a href='../alteracao/encerrar_conta.php?id_conta=$id_conta'>Encerrar Conta</a></td>
			</tr>";
			
		}
}
?>								
	<button ><a href="../cadastro/cad_conta.php"> Incluir Contas</a></button>
	<a href="../index.php">Página Inicial</a>	
	</table>
</html>