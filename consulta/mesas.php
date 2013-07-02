<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_mesas.php"; ?>
			<ul>
		</div>
	
	<div class="area_de_tabelas">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 30px;">ID</th>
			<th style="width: 76px;">Nº da Mesa</th>
			<?php
			if($permissao_sessao==0){
				echo'<th style="text-align: right;">Opções</th>';
			}
			?>
		
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
			<td>$nro_mesa</td>";
			if($permissao_sessao==0){
				echo "<td style='text-align: right;'><a href='../exclusao/del_mesa.php?id=$id_mesa'><i class='excluir'></a></td>";
			}
		echo"</tr>";  
}
?>								


	</table>
		
	<br />
	<?php
		include "../includes/verifica_get.php";
		?>
	
	
	</div>
	
		<?php 
		
		if($permissao_sessao==0){
			$href = "/cadastro/cad_mesa.php"; include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_incluir.php";
		}
		?>
	</body>
</html>