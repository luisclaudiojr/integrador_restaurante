<?php
	ob_start();
	include "conexao.php";
	if ((isset($_POST['Entrar'])) && ($_POST['Entrar'] == 'Entrar')){
		$cont_erro=0;
		$usuariologin=$_POST['txtusuario'];
		$senhalogin=$_POST['txtsenha'];
	}
?>
<html>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
<body>	
		<div id="conteudo" align="center">
				<div id="login">				
						<form name="login" method="post" action="index.php">
						
							<style>
								
								.input { color:gray; font-size:1em;display:block; background:white; border:1px solid silver;width:18	0px; padding:5px; border-radius:3px; margin:5px; }
								
								
								.entrar {
								border-style: none;
								   border-top: 1px solid #b8ffc0;
								   background: #28692a;
								   background: -webkit-linear-gradient(top, rgb(61, 196, 48), rgb(24, 153, 29));
								   padding: 8px 16px;
								   -webkit-border-radius: 4px;
								   -moz-border-radius: 4px;
								   border-radius: 4px;
								   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
								   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
								   box-shadow: rgba(0,0,0,1) 0 1px 0;
								   text-shadow: rgba(0,0,0,.4) 0 1px 0;
								   color: white;
								   font-weight: bold;
								   text-decoration: none;
								   vertical-align: middle;
								   }
								.entrar:hover {
								   border-top-color: #2f8c27;
								   background: rgb(47, 177, 35);
								   color: #ccc;
								   }
								.entrar:active {
								   border-top-color: #1b400f;
								   background: #1b400f;
								   }
								
								
							</style>
							
							<input style="margin-top:30px" class="input" type="text" placeholder='Usuario' name="txtusuario" required size="12" maxlength="30" style="border:1px solid #828282;">
							<input class="input" type="password" name="txtsenha" placeholder='Senha' required size="12" maxlength="30">

							<input class="input entrar" name='Entrar' type="submit" id="submit" value='Entrar'>

								

									<?php
									if ((isset($_POST['Entrar'])) && ($_POST['Entrar'] == 'Entrar')){
										
									
											$senha1=md5($senhalogin);
											$res=mysql_query("SELECT * from funcionario  WHERE usuario ='$usuariologin'");

											$dados=mysql_fetch_array($res);
												$bd_usr = $dados['usuario'];
												$bd_senha = $dados['senha'];
												$bd_permissao = $dados['permissao'];
												$id_func = $dados['id_funcionario'];
												$nome_func = $dados['nome_funcionario'];
										    if(($bd_usr==$usuariologin)and($bd_senha==$senha1)){
												session_start();
												$_SESSION['usuario'] = $bd_usr;
												$_SESSION['senha'] = $bd_senha;
												$_SESSION['id_sessao']=session_id();				
												$_SESSION['permissao']=$bd_permissao;
												$_SESSION['id_funcionario']=$id_func;
												$_SESSION['nome_funcionario']=$nome_func;
												
												header ("Location: index_escolhe.html");
											}else{
												echo ' Usuário e/ou senha incorretos!';
											}
											
										
									}
									?>

						</form>

</body>
</html>