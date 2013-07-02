
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_funcionarios.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_cadastrar_alterar.php"; ?>
			<ul>
		</div>

		
	
		
<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query			 =	 mysql_query("Select nome_funcionario,data_admissao,usuario,permissao from funcionario where id_funcionario=$id");
	$dados 			 = 	mysql_fetch_array($query);
	//busca os dados pelo id e depois armazena na variavel
	$nomefunc		 =	$dados['nome_funcionario'];
	$data_admissao	 =	$dados['data_admissao'];
	$usuario		 =  $dados['usuario'];
	$permissao		 =	$dados['permissao'];
	//transformando em data
	$data_admissao	 =	date("Y-m-d", strtotime($data_admissao));
}
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$nomefunc 		= $_POST['txtnome'];
	$data_admissao  = $_POST['data_admissao'];
	$usuario		= $_POST['usuario'];
	$senha1			= $_POST['senha'];
	$senha2			= $_POST['senha2'];	
	$permissao		= $_POST['permissao'];
	if($senha1!=$senha2){
		$erro = 'Senhas não conferem';
	}
}
?>
<html>
<?php
if(isset($_GET['id'])){
//se houve a passada de um id ele vai realizar a alteração
	$action="cad_func.php?id=$id";
}else{
	$action="cad_func.php";
}	
	?>
	<form name="cadastro_funcionario" class="form" method="POST" action="<?php echo $action;?>">
	
		<div class="area_de_tabelas">
					<label for="txtnome">Nome</label>
					<input type="text" id="nome_func" maxlength="50" required value='<?php  if (isset($_GET['id'])){ echo $nomefunc; }?>' name="txtnome">
					<br />
					<label for="Usuario">Usuario:</label>
					<input type="text" id="usuario" maxlength="50" required value='<?php  if (isset($_GET['id'])){ echo $usuario; }?>' name="usuario">
					<br />
					<label for="permissao">Permissao</label>
					<input type="radio" name="permissao" value="0" <?php if (isset($_GET['id'])){ if($permissao==0){ echo 'checked';} }?>>Gerente 
					<input type="radio" name="permissao" value="1" <?php if (isset($_GET['id'])){ if($permissao==1){ echo 'checked';} }?> >Operacional
					<br/>
					<?php if(!isset($_GET['id'])){
					echo '<label for="Senha">Senha:</label>
						<input type="password" id="Senha" maxlength="50" required  name="senha"><br />';
						
						echo '<label for="Senha">Repita a senha:</label>
						<input type="password" id="senha2" maxlength="50" required  name="senha2"><br />';
						
					}?>
					<label for="data_admissao">Admissão</label>
					<input type="date" id="data_admissao"  value="<?php  if (isset($_GET['id'])){ echo $data_admissao; }else{ echo date("Y-m-d");}?>" name="data_admissao">
					
				
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
				'data_admissao' 	   => $data_admissao,
				'nome_funcionario'     => $nomefunc,
				'usuario'			   => $usuario,
				'permissao'			   => $permissao
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
	else{
	//se for setado algo e não haver o ID é inclusao
	if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
		
			//armazena qual é o campo do bd e qual é a variavel que faz referencia, facilita pra nao ficar escrevendo a query, ele utiliza a funcao inclusaobd que esta na pasta funcoes/funcoesbd
			$campos=array
			(
				'data_admissao' 	   => $data_admissao,
				'nome_funcionario'     => $nomefunc,
				'usuario'			   => $usuario,
				'senha'				   => md5($senha1),
				'permissao'			   => $permissao			
			);
			//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
			$sucesso = inclusaobd("funcionario",$campos);	
				if($sucesso)
				{
				 header ("Location: ../consulta/funcionarios.php?incluido=true");
				}else{
				 header ("Location: ../consulta/funcionarios.php?incluido=false");
				}
		}
	}
}
?>

