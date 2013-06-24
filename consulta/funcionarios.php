<html>
	
	<?php include "../includes/head.php"; ?>
	
	<table>
		<tr>
			<th>Nro</th>
			<th>Nome</th>
			<th>Admissao</th>
			<th>Alterar</th>
			<th>Excluir</th>
		</tr>
<?php		
include "../conexao.php";
$cont			=	0;
$query			=	 mysql_query("Select * from funcionario");

while($dados 	= 	 mysql_fetch_array($query))
{
	$cont++;
	$nome					=	$dados['nome_funcionario'];
	$data_admissao			=	$dados['data_admissao'];
	$id						=	$dados['id_funcionario'];
	$data_admissao			=	date("d/m/Y", strtotime($data_admissao));
	echo "
		<tr>
			<td>$cont</td>
			<td>$nome</td>
			<td>$data_admissao</td>
			<td><a href='../alteracao/alt_func.php?id=$id'>Alterar</a></td>
			<td><a href='../exclusao/del_func.php?id=$id'>Excluir</a></td>
		</tr>";
}
?>								
	<button ><a href="../cadastro/cad_func.php"> Incluir Funcionario</a></button>
			<a href='/menu.php' class="desabilitar_link voltar_para_menu" data-titulo="menu">Voltar</a>
	</table>
</html>