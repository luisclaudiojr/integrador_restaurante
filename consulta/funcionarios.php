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
		//trata para ver se foi excluido
		if(isset($_GET['excluido'])){
			$excluido=$_GET['excluido'];	
			if($excluido=='true'){
				?>
					<div class="msg_sucesso">Funcionário excluido.</div>
				<?php
				}else{
				?>
					<div class="msg_erro">Funcionário possui registros, impossível excluir.</div>
				<?php
				}
			}
			if(isset($_GET['alterado'])){
				$alterado=$_GET['alterado'];	
				if($alterado=='true'){
				?>
					<div class="msg_sucesso">Funcionário Alterado.</div>
				<?php
				}else{
				?>
					<div class="msg_erro">Ocorreu Algum erro ao alterar o Funcionario.</div>
				<?php
				}
			}
			if(isset($_GET['incluido'])){
				$incluido=$_GET['incluido'];	
					if($incluido=='true'){
						?>
							<div class="msg_sucesso">Funcionário incluido com sucesso.</div>
						<?php
						}else{
						?>
							<div class="msg_erro">Ocorreu Algum erro ao Incluir o Funcionário.</div>
						<?php
						}
			}
		?>
		

	
	</div>
	
	<button class="fundo_1" ><a href="/cadastro/cad_func.php"><i class='incluir'></i>Incluir Funcionario</a></button>
	
	</body>
</html>