<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_3" data-titulo="contas" ><i class="contas"></i>Contas em Aberto</a></li>
			<ul>
		</div>

		
	<div class="area_de_tabelas">
	
	
		
<?php
	include "../conexao.php";
	$query			=	 mysql_query("Select id_conta,data_entrada,mesa.nro_mesa,nome_funcionario from conta  INNER JOIN mesa ON(conta.MESA_id_mesa=mesa.id_mesa)INNER JOIN funcionario ON(conta.FUNCIONARIO_id_funcionario=funcionario.id_funcionario) where status_conta='A' order by mesa.nro_mesa");
	$ver_conta		=	 mysql_num_rows($query);
	if(!$ver_conta){
		echo "<p class='sem_registros'>NÃO HÁ NENHUMA CONTA EM ABERTO</p>";
		}else{
?>

	





	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 45px;">Conta</th>
			<th style="width: 45px;">Mesa</th>
			<th style="width: 114px;">Entrada</th>
			<th>Funcionario</th>
			<th style="width: 80px;">Valor Total</th>
			<th style="width: 108px;">Opções</th>
		</tr>
		</thead>
		<?php		
//status A = Aberto  - F = Fechada

	while($dados 	= 	 mysql_fetch_array($query))
	{
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
			}

		
		echo "
			<tr>
				<td>$id_conta</td>
				<td>$nro_mesa</td>
				<td>$data_entrada</td>
				<td>$nome_func</td>
				<td>R$ $valor_final</td>
				<td><a href='../consulta/pedidos.php?id_conta=$id_conta&mesa=$nro_mesa'><i class='ver'></i></a>
				<a href='../exclusao/del_conta.php?id_conta=$id_conta'><i class='excluir'></i></a>
				<a href='../alteracao/encerrar_conta.php?id_conta=$id_conta'><i class='fechar_conta'></i></a></td>
			</tr>";
			
		}
}
?>								
	
	</table>
	
	
	
	
	
		<?php
		if(isset($_GET['excluido'])){
			$excluido=$_GET['excluido'];
			
			echo "<br />";
			
			if($excluido=='true'){
				?>

					<div class="msg_sucesso">Conta excluida.</div>
				
				<?php
				}else{
				?>

					<div class="msg_erro">Conta possui registros, exclua primeiro ítens desta conta.</div>
				
				<?php
				}
				
			}
		
		?>
	
	
	
	
	
	
	
	</div>
	<button class="fundo_1" ><a href="/cadastro/cad_conta.php"><i class='incluir'></i>Incluir Contas</a></button>
	
	
</body>	
</html>