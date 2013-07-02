<?php
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id_conta		=	$_GET['id_conta'];

$linha_afetada	=	mysql_num_rows(mysql_query("SELECT status_pedido FROM PEDIDO WHERE CONTA_id_conta=$id_conta and status_pedido='P'"));
//verifica se há pedidos pendentes, se houver ele não deixa você encerrar a conta!

$mesa			=	mysql_fetch_array(mysql_query("SELECT MESA_id_mesa FROM conta WHERE id_conta=$id_conta"));
$id_mesa		=   $mesa['MESA_id_mesa'];

if($linha_afetada>0){
		header("location: ../consulta/contas.php?pedidos=pendentes ");
}else{
	$valor_final		=	0;
	$consulta_valor		=	mysql_query("Select qtd,vlr_unitario,nome_item from pedido inner join item ON( pedido.ITEM_id_item=item.id_item) where CONTA_id_conta=$id_conta");
	$ver_pedido			=	mysql_num_rows($consulta_valor);
	if($ver_pedido){
		while($dados 		= 	 mysql_fetch_array($consulta_valor))
		{
			$qtd				=	$dados['qtd'];
			$vlr_unitario		=	$dados['vlr_unitario'];
			$item				=	$dados['nome_item'];
			$valor_total		=	$qtd*$vlr_unitario;
			$valor_final		=	$valor_total+$valor_final;
			$array_itens[]	    =	"<span style='text-transform:uppercase;width:281px;'><b>$item</b></span><span style='text-align:right;float:right;width:100px;'><b>R$ $valor_total</b></span><br />(Valor-Unit: R$$vlr_unitario | Qtd: $qtd)<br>"; 
			
		}

		$total_array 		=	count($array_itens);

		
?>

<html>
	
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
<body>
	
	
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_contas.php"; ?>
				<li><a style="background:rgb(133,133,133);" class="desabilitar_link" data-titulo="contas" ><i class="faturamento"></i>Encerrar Conta <?php echo $id_conta; ?></a></li>
			<ul>
		</div>

		
	
	<div class="area_de_tabelas">
	
		<div class="" style="font-family: consolas;background: rgb(255, 255, 179); max-width:435px;">
			
			<div style="padding:30px; padding-left:10px;padding-right:10px;border:2px dashed black; border-top:0; border-bottom: 0;background:; margin:20px;margin-top:0; margin-bottom:0;">
			
					-----------------------------------------<br />
					Empresa: RESTAURANTE.COM<br />
					Documento: NOTA FISCAL<br />
					Conta numero: <?php echo $id_conta; ?><br />
					Data: <?php echo date("Y-m-d H:i:s"); ?><br />
					-----------------------------------------<br />
					Conta Detalhada:<br /><br />
					
					
					<?php for($x=0;$total_array>$x;$x++){
						echo $array_itens[$x]."<br>";
					}?>

					-----------------------------------------<br />
					<span style="text-align:right;">Valor TOTAL da Conta: <b>R$ <?php echo $valor_final; ?> </b></span>
				
				
			</div>
			
		</div>
	
	</div>
	
	
	<form name="Encerrar Conta" method="POST" action="encerrar_conta.php?id_conta=<?php echo $id_conta; ?>">
	<div class="area_de_tabelas">
			<label id="labelcentro">Tipo de pagamento</label>
				<select name='tipo' id='tipo' required>
				<option value="">--TIPO--</option>
				<option value='1'>Cheque</option>
				<option value='2'>Dinheiro</option>
				<option value='3'>Cartão</option>				
				</select>
				
			</div>
			
			<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_salvar_cancelar.php"; ?>
			
	</form>

	
<?php
		if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

			$tipo_pag	=	$_POST['tipo'];
				//altera os dados
			$campos=array
					(
						'status_conta' 	   => 'F',
						'vlr_total' 	   => $valor_final,
						'tipo_pagamento'   => $tipo_pag,
						'data_saida' => date("Y-m-d H:i:s")
					);
			$condicao = "where id_conta = $id_conta";
			$sucesso  = alteracaobd("conta", $campos, $condicao);
			//passa como L (liberado) o status da mesa se houver a alteração e encerramento da conta
			$campos2=array
			(
				'status' 	   				 => 'L'								  
			);
			
			$where = "where id_mesa=$id_mesa";
			$alt_pos_mesa  = alteracaobd("mesa",$campos2,$where);	
			header("location: ../consulta/contas.php ");

		}
	}else{ //caso não há nenhum pedido, não tem como encerrar a conta, nesse caso é recomendado a exclusão
		header("location: ../consulta/contas.php?pedidos=inexistentes");

	}
}

?>
</body>

</html>