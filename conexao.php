 <?php
	include ("config/config.php");
	
	$conexao  = mysql_connect($servidor_bd,$usuario_bd,$senha_bd); 
	if (!$conexao) {
	    die('Não foi possível conectar ao banco: ' . mysql_error());
	}
	$db_selected = mysql_select_db($banco_bd,$conexao);
	if (!$db_selected) {
	    die ("Não foi possível usar o banco '$banco_bd' : " . mysql_error());
	}
	
	
?>