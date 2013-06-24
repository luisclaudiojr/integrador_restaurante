<?php
	ob_start();
	include "conexao.php";
	if(isset($_POST['Acessar']) && $_POST['Acessar'] == ""){
		$cont_erro=0;
		$usuariologin=$_POST['txtusuario'];
		$senhalogin=$_POST['txtsenha'];
	}
?>
<html>
<head>
	<title>Integrador</title>
	
</head>
	
<body>	
		<div id="conteudo" align="center">
				<div id="login">				
						<form name="login" method="post" action="index.php">
							<table border="0" valign="bottom">
								<tr>
								<td align="center" ><font size="2">Usu&aacute;rio</td>
								<td align="center"><font size="2">Senha</td>
								<td>&nbsp;</td>
								</tr>
								<tr>
								<td><input type="text" name="txtusuario" required size="12" maxlength="30" style="border:1px solid #828282;"></td>
								<td><input type="password" name="txtsenha" required size="12" maxlength="30" style="border:1px solid #828282;"></td>
								<td><input type="submit" id="submit" value='Acessar' ></td>
								</tr>
								<tr>
								
								<td colspan="3" >
									<?php
									if(isset($_POST['Acessar']) && $_POST['Acessar'] == ""){
										
									
											$senha1=md5($senhalogin);
											$res=mysql_query("SELECT * FROM usuario  WHERE usuario ='$usuariologin'");

											$dados=mysql_fetch_array($res);
												$bd_usr=$dados['usuario'];
												$bd_senha=$dados['senha'];
												$bd_permissao=$dados['permissao'];
												
										    if(($bd_usr==$usuariologin)and($bd_senha==$senha1)){
												session_start();
												$_SESSION['usuario']=$bd_usr;
												$_SESSION['senha']=$bd_senha;
												$_SESSION['id_sessao']=session_id();				
												
												header ("Location: index.php");
											}else{
												echo ' Usuário e/ou senha incorretos!';
											}
											
										
									}
									?>
								</td>
								</tr>
							</table>
						</form>

</body>
</html>