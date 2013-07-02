
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_funcionarios.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_alterar_senha.php"; ?>
			<ul>
		</div>

		
	
		
<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
}
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$senha1			= $_POST['senha'];
	$senha2			= $_POST['senha2'];	

	if($senha1!=$senha2){
		$erro = 'Senhas não conferem';
	}
}
?>
<html>
<?php
if(isset($_GET['id'])){
//se houve a passada de um id ele vai realizar a alteração
	$action="alt_senha.php?id=$id";
}else{
	$action="alt_senha.php";
}	
	?>
	<form name="cadastro_funcionario" class="form" method="POST" action="<?php echo $action;?>">
	
		<div class="area_de_tabelas">
					
					<label for="Senha">Senha:</label>
						<input type="password" id="Senha" maxlength="50" required  name="senha"><br />
						
						<label for="Senha">Repita a senha:</label>
						<input type="password" id="senha2" maxlength="50" required  name="senha2"><br />
				
		</div>
				<?php
				if(isset($erro)){
							echo'<div class="msg_erro">Senhas Não conferem!</div>';
				}
				?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_salvar_cancelar.php"; ?>

				

	</form>


</body>
</html>
<?php
if(!isset($erro)){
	//se cair aqui é porque é alteracao
	if(isset($_GET['id'])){
		if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
			
			$campos=array
			(
				'senha' 	   		=> md5($senha1)
			);
			$condicao = " where id_funcionario=$id";
			$sucesso = alteracaobd("funcionario",$campos,$condicao);	
			if($sucesso)
				{
				 header ("Location: ../consulta/funcionarios.php?alterado=true");
				}else{
				 header ("Location: ../consulta/funcionarios.php?alterado=false");
				}
		}
		
	}
	//se não é apenas inclusao
	
}
?>

