<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_2" data-titulo="funcionarios"><i class="funcionarios"></i>Funcionarios</a></li>
			<ul>
		</div>
	
	
	<div class="area_de_tabelas">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 20px;">Nº</th>
			<th>Nome</th>
			<th style="width: 77px;">Admissao</th>
			<th style="width: 51px;">Opções</th>
		</tr>
		</thead>
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
			<td style='text-transform:uppercase;'>$nome</td>
			<td>$data_admissao</td>
			<td><a href='../cadastro/cad_func.php?id=$id'><i class='editar'></i></a>  <a href='../exclusao/del_func.php?id=$id'><i class='excluir'></i></a></td>
		</tr>";
}
?>								
	
	</table>
	<br />

		<?php
		include "../includes/verifica_get.php";
		?>
		

	
	</div>
	
	<button class="fundo_1" ><a href="/cadastro/cad_func.php"><i class='incluir'></i>Incluir Funcionario</a></button>
	
	</body>
</html>