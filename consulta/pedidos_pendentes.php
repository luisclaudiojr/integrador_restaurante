<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>

<body>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_7" data-titulo="pendencias"><i class="pendencias"></i>Pedidos Pendentes</a></li>
			<ul>
		</div>

	<div class="area_de_tabelas">
<?php

// Função para calcular horário
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
//verifica se há pedidos pendentes, se houver ele não deixa você encerrar a conta!

if($linha_afetada=0){
	echo "Não há pedidos pendentes!";
	echo '<a href="/menu.php" class="desabilitar_link voltar_para_menu" data-titulo="menu">Voltar</a>';
}else{
echo"

	<table border='0' cellpadding='0' cellspacing='0' width='100%'>
		<thead>
		<tr>
			<th style='width: 36px'>Mesa</th>
			<th style='width: 41px'>Conta</th>
			<th style='width: 54px'>Data</th>
			<th style='width: 27px '>Qtd</th>
			<th>Item</th>
			<th>Descri��o</th>
			<th style='width: 71px'>Espera</th>
			<th style='width: 51px;'>Op��es</th>		
		</tr>
		</thead>
		";

	while($dados		=	mysql_fetch_array($query)){
		$nro_mesa		=	$dados['nro_mesa'];
		$id_conta		=	$dados['id_conta'];
		$data_pedido	=	$dados['data_pedido'];
		$descricao		=	$dados['descricao_pedido'];
		$nome_item		=	$dados['nome_item'];
		$qtd			=	$dados['qtd'];
		$data_atual		=	date("h:i:s"); 
		$data_pedido	=	date("h:i:s", strtotime($data_pedido));

	
		//usei uma classe do php que ja me faz o calculo da diferença entre as horas
		$date_time 		=	new DateTime( $data_pedido );
		$diff 			=	$date_time->diff( new DateTime( $data_atual) );
		$tempo_espera	=	$diff->format( '%H:%i' );
		echo "
		<tr>
				<td>$nro_mesa</td>
				<td>$id_conta</td>
				<td>$data_pedido</td>
				<td>$qtd</td>
				<td>$nome_item</td>
				<td>$descricao</td>
				<td>$tempo_espera Min</td>
					<td><a href='../alteracao/alt_pos_pedido.php?id_pedido=$id_pedido&pendentes=true'><i class='editar'></i></a></td>
		</tr>
		
		";
	}//o certo é fazer aparecer em vermelho os que aparecerem mais de 30min
}
?>
	</div>