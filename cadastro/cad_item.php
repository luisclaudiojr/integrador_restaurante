<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$nome_item		= $_POST['nome_item'];
	$vlr_unitario   = $_POST['vlr_unitario'];
	$cont_erro 		= 0;
}
?>
<html>
	<form name="cadastro_item" method="POST" action="cad_item.php">
		<fieldset>
			<legend>CADASTRO DE ITEM</legend>
				<p>
					<label>Nome Item</label>
					<?php
					
					if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
						if($nome_item == ""){
							echo "Informe o nome do item"; 
							$cont_erro++;
						}
					} ?>
					
					<input type="text" id="nome_item" maxlength="50" required value='<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $nome_item ;}?>' name="nome_item">
				</p>
				<p>
					<label >Valor Unitario</label>
						<?php
						
						if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
							if($vlr_unitario == ""){
								echo "Informe o Valor Unitario"; 
								$cont_erro++;
							}
						} ?>
					<input type="text " id="vlr_unitario"  value="<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $vlr_unitario; }?>" name="vlr_unitario">
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
			'vlr_unitario' 	   => $vlr_unitario,
			'nome_item'     => $nome_item	 								  
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$sucesso = inclusaobd("item",$campos);	
		if($sucesso){
			echo "Registro Inserido";
		}else{
			echo "Erro ao Inserir";
		}
	}
}

?>