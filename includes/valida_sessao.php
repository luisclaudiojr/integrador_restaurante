<?php
    ob_start();
    session_start ();
	
    if (!isset($_SESSION['id_sessao']))
	 {
	  unset ($_SESSION['id_sessao']);
?>             
			<script language="javascript">
		alert("SESS�O N�O INICIADA - INSIRA USUARIO E SENHA, CASO N�O POSSUA PE�A AO GERENTE PARA CRIAR UMA PARA VOC�");
								location="index.php";
		</script>

<?php
	  exit;
     } else {
	    if ($_SESSION['id_sessao'] != session_id())
		{
		       unset ($_SESSION['id_sessao']);
		?>             
			<script language="javascript">
					alert("SESS�O N�O INICIADA - INSIRA USUARIO E SENHA, CASO N�O POSSUAPE�A AO GERENTE PARA CRIAR UMA PARA VOC�");
					location="index.php";
		</script>

		<?php
		       exit;
	    }else {
				$usuario_sessao		=  $_SESSION['usuario'];
				$senha_sessao 		=  $_SESSION['senha'];
				$permissao_sessao	=  $_SESSION['permissao'];	
				$func_sessao		=  $_SESSION['nome_funcionario'];
				$id_func_sessao		=  $_SESSION['id_funcionario'];								
			}
        }

	//mysql_close($conexao);
?>