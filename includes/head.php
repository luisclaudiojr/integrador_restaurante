<?php
ob_start();
@session_start();
if(isset($_SESSION['id_sessao'])){
				$usuario_sessao		=  $_SESSION['usuario'];
				$senha_sessao 		=  $_SESSION['senha'];
				$permissao_sessao	=  $_SESSION['permissao'];	
				$func_sessao		=  $_SESSION['nome_funcionario'];
				$id_func_sessao		=  $_SESSION['id_funcionario'];	
}
?>
<head>
	<meta charset="utf-8" />
	<title> PROJETO INTEGRADOR - RESTAURANTE </TITLE>
  <link type="text/css" rel="stylesheet" charset="UTF-8" href="/_assets/css/style.css">

</head>