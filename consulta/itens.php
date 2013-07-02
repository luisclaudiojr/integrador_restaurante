<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_itens.php"; ?>
			<ul>
		</div>
	
	<div class="area_de_tabelas">
	
<?php		
include "../conexao.php";
$cont			=	0;
$query			=	 mysql_query("Select * from item");
$linhas			=	 mysql_num_rows($query);
if(!$linhas){
	echo "<p class='sem_registros'>NÃO HÁ ITENS CADASTRADOS</p>";
}ELSE{
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 28px;">Nº</th>
			<th>Descrição</th>
			<th style="width: 75px;">Valor Unit.</th>
			<?php if($permissao_sessao==0){ echo '	<th style="width: 51px;">Opções</th>';} ?>

		</tr>
		</thead>
<?PHP
while($dados 	= 	 mysql_fetch_array($query))
{
	$cont++;
	$id				=	$dados['id_item'];
	$nome_item				=	$dados['nome_item'];
	$vlr_unitario			=	$dados['vlr_unitario'];


	echo "
		<tr>
			<td>$cont</td>
			<td style='text-transform: lowercase;'>$nome_item</td>
			<td>R$ $vlr_unitario</td>
			";
			if($permissao_sessao==0){
				echo"
				<td><a href='../cadastro/cad_item.php?id=$id'><i class='editar'></i></a>
				<a href='../exclusao/del_item.php?id=$id'><i class='excluir'></i></a></td>";
			}echo"
		</tr>";
}
?>								
	</table>
	<br />

		<?php
		}
		include "../includes/verifica_get.php";
		?>
		
</div>
		<?php 
		
		if($permissao_sessao==0){
			$href = "/cadastro/cad_item.php"; include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_incluir.php"; 
		}
		?>
	</body>
</html>