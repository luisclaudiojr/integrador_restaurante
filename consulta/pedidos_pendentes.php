<?php

// Fun��o para calcular hor�rio
function dif_horario($horario1, $horario2) {
    //$horario1 = strtotime("$horario1");
    //$horario2 = strtotime("$horario2");
         
 if ($horario2 < $horario1) {
    $horario2 = $horario2 + 86400;
 }
  
return ($horario2 - $horario1) / 3600;      
}
  

include "../conexao.php";
$query=mysql_query("SELECT nro_mesa,id_conta,data_pedido,descricao_pedido,nome_item,qtd FROM PEDIDO inner join item on (ITEM.id_item=pedido.ITEM_id_item) INNER JOIN CONTA ON (pedido.CONTA_id_conta=CONTA.id_conta) INNER JOIN MESA ON (CONTA.MESA_id_mesa=MESA.id_mesa) WHERE status_pedido='P' ");

$linha_afetada	=	mysql_num_rows($query);
//verifica se h� pedidos pendentes, se houver ele n�o deixa voc� encerrar a conta!

if($linha_afetada=0){
	echo "N�o h� pedidos pendentes!";
	echo "<br><a href='../index.php'>Voltar</a>";
}else{
echo"
		<table>
		<tr>
			<th>Nro Mesa</th>
			<th>Nro conta</th>
			<th>Data Pedido</th>
			<th>Item</th>
			<th>Qtd </th>
			<th>Descri��o</th>
			<th>Tempo de Espera</th>
			
		</tr>";

	while($dados		=	mysql_fetch_array($query)){
		$nro_mesa		=	$dados['nro_mesa'];
		$id_conta		=	$dados['id_conta'];
		$data_pedido	=	$dados['data_pedido'];
		$descricao		=	$dados['descricao_pedido'];
		$nome_item		=	$dados['nome_item'];
		$qtd			=	$dados['qtd'];
		$data_atual		=	date("h:i:s"); 
		$data_pedido	=	date("h:i:s", strtotime($data_pedido));

	
		//usei uma classe do php que ja me faz o calculo da diferen�a entre as horas
		$date_time 		=	new DateTime( $data_pedido );
		$diff 			=	$date_time->diff( new DateTime( $data_atual) );
		$tempo_espera	=	$diff->format( '%H:%i' );
		echo "
		<tr>
				<td>$nro_mesa</td>
				<td>$id_conta</td>
				<td>$data_pedido</td>
				<td>$nome_item</td>
				<td>$qtd</td>
				<td>$descricao</td>
				<td>$tempo_espera Min</td>
		</tr>
		
		";
	}//o certo � fazer aparecer em vermelho os que aparecerem mais de 30min
		echo "<br><a href='../index.php'>Voltar</a>";
}
?>