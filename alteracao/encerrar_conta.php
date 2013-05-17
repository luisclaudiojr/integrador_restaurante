<?php
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id_conta		=	$_GET['id_conta'];

$linha_afetada	=	mysql_num_rows(mysql_query("SELECT status_pedido FROM PEDIDO WHERE CONTA_id_conta=$id_conta and status_pedido='P'"));
//verifica se há pedidos pendentes, se houver ele não deixa você encerrar a conta!

if($linha_afetada>0){
	echo "Há algum pedido pendente para essa conta, por favor finalize-o para poder encerrar a conta";
		echo "<br><a href='../consulta/contas.php'>Voltar</a>";
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
			$array_itens[] =	"$item : -- Valor-Unitario:$vlr_unitario -- Quantidade: $qtd -- Valor total: R$ $valor_total<br>"; 
			
		}

		$total_array 		=	count($array_itens);
		for($x=0;$total_array>$x;$x++){
			echo $array_itens[$x]."<br>";
		}
		echo "Valor total da Conta: R$".$valor_final;
?>
<form name="Encerrar Conta" method="POST" action="encerrar_conta.php?id_conta=<?php echo $id_conta; ?>">
		<fieldset>
			<legend>Tipo de Pagamento</legend>			
			<p><label id="labelcentro">Tipo de pagamento</label>
				<select name='tipo' id='tipo' required>
				<option value="">--tipo--</option>
				<option value='1'>Cheque</option>
				<option value='2'>Dinheiro</option>
				<option value='3'>Cartão</option>				
				</select>
			</p>
			<p>
				<input type="submit" name="enviar" value="Enviar" class="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="reset" value="Limpar" class="button">
			</p>
				
		</fieldset>
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
			header("location: ../consulta/contas.php ");

		}
	}else{ //caso não há nenhum pedido, não tem como encerrar a conta, nesse caso é recomendado a exclusão
		echo 'Não há pedidos para essa conta, por favor lance os registros para poder encerrar a conta';
	}
}

?>
