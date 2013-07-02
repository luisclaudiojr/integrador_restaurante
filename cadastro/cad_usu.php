<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$usuario		= $_POST['txtusuario'];
	$senha		    = $_POST['senha'];
	$func			= $_POST['func'];
	$cont_erro 		= 0;
}
?>
<html>
	<form name="cadastro_usuario" method="POST" action="cad_usu.php">
		<fieldset>
			<legend>CADASTRO DE USUARIOS</legend>
				<p>
					<label>Usuario</label>
		
					
					<input type="text" id="usuario" maxlength="50" required value='<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $usuario ;}?>' name="txtusuario">
				</p>
				<p>
					<label >Senha</label>
						<input type="password" id="senha"  value="<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $senha; }?>" name="senha">
				</p>
				<label id="labelcentro">Funcionario</label>
				<select name='func'>
				<?php
				$sql = "SELECT * FROM funcionario ORDER BY nome_funcionario";
						$res = mysql_query($sql) or die ("Erro: ".mysql_error());
						while ($linha = mysql_fetch_array($res, MYSQL_ASSOC)){
							echo "<option value='".$linha["id_funcionario"]."'";
							echo ">".$linha["nome_funcionario"]."</option>";                 
						}
					?>
				</select>
				<p>
					<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_salvar_cancelar.php"; ?>
				</p>
				<a href="../index.php">Página Inicial</a>
</html>
<?php
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
	if($cont_erro == 0)
	{
		//armazena qual é o campo do bd e qual é a variavel que faz referencia, facilita pra nao ficar escrevendo a query, ele utiliza a funcao inclusaobd que esta na pasta funcoes/funcoesbd
		$campos=array
		(
			'usuario' 	   => $usuario,
			'senha'        => md5($senha),
			'FUNCIONARIO_id_funcionario' => $func
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$sucesso = inclusaobd("usuario",$campos);	
		if($sucesso){
			echo "Registro Inserido";
		}else{
			echo "Erro ao Inserir";
		}
	}
}

?>