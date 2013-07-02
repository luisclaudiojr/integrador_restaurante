<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_funcionarios.php"; ?>
			<ul>
		</div>
	
	
	<div class="area_de_tabelas">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
		<tr>
			<th style="width: 20px;">Nº</th>
			<th style="width: 20px;">Nome</th>
			<th >Usuario</th>
			
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
	$usuario				=	$dados['usuario'];
	$permissao				=	$dados['permissao'];
	if($permissao==0){
		$permissao = 'Gerente';
	}else{
		$permissao = 'Operacional';
	}
	$data_admissao			=	date("d/m/Y", strtotime($data_admissao));
	echo "
		<tr>
			<td>$cont</td>
			<td style='text-transform:uppercase;'>$nome</td>
			<td style='text-transform:uppercase;'>$usuario</td>
			
			<td>$data_admissao</td>
			<td><a href='../cadastro/cad_func.php?id=$id'><i class='editar'></i></a><a href='../alteracao/alt_senha.php?id=$id'><i class='editar_senha'></i></a> <a href='../exclusao/del_func.php?id=$id'><i class='excluir'></i></a></td>
		</tr>";
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
			$href = "/cadastro/cad_func.php"; include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_incluir.php"; 
		}	
			?>
		
	</body>
</html>