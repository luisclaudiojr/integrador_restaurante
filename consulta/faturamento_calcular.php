<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>

<?php
include "../conexao.php";

$valor_total	=	0;
$data1			=	$_POST['data'];
$data2			=	$_POST['data2'];
$sql			=   "Select data_entrada,id_conta,vlr_total from conta where data_entrada>='$data1 00:00:00' and data_entrada<='$data2 23:59:59' and status_conta='F' ORDER BY DATA_ENTRADA";
$query			=	mysql_query($sql);
$linhas			=	mysql_num_rows($query);
if($linhas){
while($dados	= mysql_fetch_array($query, MYSQL_ASSOC)){
	$data_entrada	=	$dados["data_entrada"];
	$valor			=	$dados["vlr_total"];
	$id_conta		=	$dados["id_conta"];
	$data_entrada	=	date("d/m/Y h:i", strtotime($data_entrada));
	$valor_array[]	=	"<tr><td>$id_conta</td><td>$data_entrada</td><td></td><td>R$ $valor</td></tr>";
	$valor_total	=	$valor_total+$valor;

}
		//converte as datas padrao brasileiro
	$data1	=	date("d/m/Y", strtotime($data1));
	$data2	=	date("d/m/Y", strtotime($data2));

$total_array 		=	count($valor_array);



?>

		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a href='/consulta/faturamento.php' class="desabilitar_link fundo_6" data-titulo="faturamento"><i class="faturamento"></i>Faturamento</a></li>
				<li><a class="desabilitar_link fundo_7"><i class="data"></i>Faturamento entre <?php echo $data1; ?> e  <?php echo $data2; ?> </a></li>
			<ul>
		</div>
		
		
		<div class="area_de_tabelas">

		
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 64px;">Conta</th>
			<th style="width: 117px;">Data de Entrada</th>
			<th></th>
			<th style="width: 80px;">Valor</th>
		</tr>
		</thead>
		<?php for($x=0;$total_array>$x;$x++){
			echo $valor_array[$x];
		} ?>
	</table>
	
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th></th>
			<th style="width: 80px;">TOTAL</th>
		</tr>
		</thead>
		<tr>
			<td></td>
			<td>R$ <?php echo $valor_total; ?></td>
		</tr>
	</table>
	
	
	
		
<?php
}else{
	header("location: ../consulta/faturamento.php?faturamento=false ");
}
?>

		</div>
