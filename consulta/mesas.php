<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_1" data-titulo="mesas"><i class="mesas"></i>Mesas</a></li>
			<ul>
		</div>
	
	<div class="area_de_tabelas">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 30px;">ID</th>
			<th style="width: 76px;">Nº da Mesa</th>
			<th style="text-align: right;">Opções</th>
		</tr>
		</thead>
		<?php		
include "../conexao.php";
$cont			=	0;
$query			=	 mysql_query("Select * from mesa ");

while($dados 	= 	 mysql_fetch_array($query))
{
	$cont++;
	$id_mesa				=	$dados['id_mesa'];
	$nro_mesa				=	$dados['nro_mesa'];
	echo "
		<tr>
			<td>$cont</td>
			<td>$nro_mesa</td>
			<td style='text-align: right;'><a href='../exclusao/del_mesa.php?id=$id_mesa'><i class='excluir'></a></td>
		</tr>";  
}
?>								


	</table>
		
	<br />
	<?php
		include "../includes/verifica_get.php";
		?>
	
	
	</div>
	
		<button class="fundo_1"><a href="../cadastro/cad_mesa.php"><i class='incluir'></i> Incluir Mesa</a></button>
	
	</body>
</html>