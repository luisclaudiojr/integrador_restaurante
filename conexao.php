 <?php
	include ("config/config.php");
	
	$conexao  = mysql_connect($servidor_bd,$usuario_bd,$senha_bd); 
	if (!$conexao) {
	    die('N�o foi poss�vel conectar ao banco: ' . mysql_error());
	}
	$db_selected = mysql_select_db($banco_bd,$conexao);
	if (!$db_selected) {
	    die ("N�o foi poss�vel usar o banco '$banco_bd' : " . mysql_error());
	}
	
	
?>