<?php
include "../conexao.php";

$valor_total	=	0;
$data1			=	$_POST['data'];
$data2			=	$_POST['data2'];
$sql			=   "Select data_entrada,id_conta,vlr_total from conta where data_entrada>='$data1' and data_entrada<='$data2' and status_conta='F' ORDER BY DATA_ENTRADA";
$query			=	mysql_query($sql);
$linhas			=	mysql_num_rows($query);
if($linhas){
while($dados	= mysql_fetch_array($query, MYSQL_ASSOC)){
	$data_entrada	=	$dados["data_entrada"];
	$valor			=	$dados["vlr_total"];
	$id_conta		=	$dados["id_conta"];
	$data_entrada	=	date("d/m/Y h:i", strtotime($data_entrada));
	$valor_array[]	=	"CONTA:$id_conta -- DATA: $data_entrada -- VALOR DA CONTA: R$ $valor";
	$valor_total	=	$valor_total+$valor;

}

$total_array 		=	count($valor_array);
		for($x=0;$total_array>$x;$x++){
			echo $valor_array[$x]."<br>";
		}

echo "VALOR TOTAL DAS CONTAS: R$ $valor_total<BR>";
}else{
Echo "Não existe fechamento para esse periodo";
}
?>
<a href='/menu.php' class="desabilitar_link voltar_para_menu" data-titulo="menu">Voltar</a>