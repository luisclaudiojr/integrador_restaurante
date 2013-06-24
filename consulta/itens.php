<html>
	
	<?php include "../includes/head.php"; ?>
	
	
	<table>
		<tr>
			<th>Nro</th>
			<th>Nome</th>
			<th>Valor Unitario</th>
			<th>Alterar</th>
			<th>Excluir</th>
		</tr>
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
			<td>$nome_item</td>
			<td>$vlr_unitario</td>
			<td><a href='../alteracao/alt_item.php?id=$id'>Alterar</a></td>
			<td><a href='../exclusao/del_item.php?id=$id'>Excluir</a></td>
		</tr>";
}
?>								
	<button ><a href="../cadastro/cad_item.php"> Incluir Itens</a></button>
			<a href='/menu.php' class="desabilitar_link voltar_para_menu" data-titulo="menu">Voltar</a>
	</table>
</html>