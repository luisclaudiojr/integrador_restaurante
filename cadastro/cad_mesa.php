<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$nro_mesa 		= $_POST['nromesa'];
	$cont_erro 		= 0;
}
?>
<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_1" data-titulo="mesas"><i class="mesas"></i>Mesas</a></li>
				<li><a class="desabilitar_link fundo_3" data-titulo="mesa"><i class="incluir"></i>Incluir Mesa</a></li>
			<ul>
		</div>
	
	<div class="area_de_tabelas">
	<form class="form" name="cadastro_mesas" method="POST" action="cad_mesa.php">
					<label for="nromesa">Mesa</label>				
					<input type="text" id="mesa_func" maxlength="3" required value='<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $nro_mesa ;}?>' name="nromesa">

					</div>
					
				<button class="fundo_1"  value="Enviar" name="enviar" type="submit"><i class='incluir'></i>Salvar</button>
				<a href="/consulta/mesa.php" class="fundo_8"><i class='cancelar'></i>Cancelar</a>
					
					
	</form>
	</body>
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