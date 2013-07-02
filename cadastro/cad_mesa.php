<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$nro_mesa 		= $_POST['nromesa'];
	$cont_erro 		= 0;
}
?>
<html>
	<form name="cadastro_mesas" method="POST" action="cad_mesa.php">
		<fieldset>
			<legend>CADASTRO DE MESAS</legend>
				<p>
					<label>Mesa</label>				
					<input type="text" id="mesa_func" maxlength="3" required value='<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $nro_mesa ;}?>' name="nromesa">
				</p>
			
				<p>
					<input type="submit" name="enviar" value="Enviar" class="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Limpar" class="button">
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
			'nro_mesa'     => $nro_mesa	 								  
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$sucesso = inclusaobd("mesa",$campos);	
		if($sucesso){
			header("location: ../consulta/mesas.php?incluido=true");	
		}else{		
			header("location: ../consulta/mesas.php?incluido=false");	
		}
	}
}

?>