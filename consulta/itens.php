<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a href='/itens.php' class="desabilitar_link fundo_2" data-titulo="itens"><i class="itens"></i>Itens</a></li>
			<ul>
		</div>
	
	<div class="area_de_tabelas">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 28px;">N�</th>
			<th>Descri��o</th>
			<th style="width: 75px;">Valor Unit.</th>
			<th style="width: 51px;">Op��es</th>
		</tr>
		</thead>
<?php		
include "../conexao.php";
$cont			=	0;
$query			=	 mysql_query("Select * from item");

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
			<td><a href='../alteracao/alt_item.php?id=$id'><i class='editar'></i></a>
			<a href='../exclusao/del_item.php?id=$id'><i class='excluir'></i></a></td>
		</tr>";
}
?>								
	</table>
</div>
		<button class="fundo_1" ><a href="../cadastro/cad_item.php"><i class='incluir'></i> Incluir Itens</a></button>
	
	</body>
</html>