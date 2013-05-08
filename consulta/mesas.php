<html>
	<table>
		<tr>
			<th>Nro</th>
			<th>Nro Mesa</th>
			<th>Excluir</th>
		</tr>
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
			<td><a href='../exclusao/del_mesa.php?id=$id_mesa'>Excluir</a></td>
		</tr>";  
}
?>								
	<button ><a href="../cadastro/cad_mesa.php"> Incluir Mesa</a></button>
	<a href="../index.php">Página Inicial</a>	
	</table>
</html>