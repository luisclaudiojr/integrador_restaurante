<?php
include "conexao.php";
include "funcoes/funcoesbd/funcoesbd.php";

	   $sql = "DELETE FROM PEDIDO ";
	   $res = mysql_query($sql);
	   
	   $sql = "DELETE FROM CONTA ";
	   $res = mysql_query($sql);
	   
	   $sql = "DELETE FROM ITEM";
	   $res = mysql_query($sql);
	   
	   $sql = "DELETE FROM MESA ";
	   $res = mysql_query($sql);
	   
	   $sql = "DELETE FROM USUARIO WHERE ID_USUARIO>1 ";
	   $res = mysql_query($sql);	
	   
	   $sql = "DELETE FROM FUNCIONARIO WHERE ID_FUNCIONARIO>1 ";
	   $res = mysql_query($sql);
		
		

?>