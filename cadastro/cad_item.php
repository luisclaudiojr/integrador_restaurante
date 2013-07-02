<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query			 =	mysql_query("Select nome_item,vlr_unitario from item where id_item = $id");
	$dados 			 = 	mysql_fetch_array($query);
	//busca os dados pelo id e depois armazena na variavel
	$nome_item		 =	$dados['nome_item'];
	$vlr_unitario	 =	$dados['vlr_unitario'];
}	
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$nome_item		= $_POST['nome_item'];
	$vlr_unitario   = $_POST['vlr_unitario'];
	$cont_erro 		= 0;
}

if(isset($_GET['id'])){
//se houve a passada de um id ele vai realizar a alteração
	$action="cad_item.php?id=$id";
}else{
	$action="cad_item.php";
}	

?>

<html>
	<form name="cadastro_item" method="POST" action="<?php echo $action;?>">
		<fieldset>
			<legend>CADASTRO DE ITEM</legend>
				<p>
					<label>Nome Item</label>					
					<input type="text" id="nome_item" maxlength="50" required value='<?php if(isset($_GET['id'])){ echo $nome_item ;}?>' name="nome_item">
				</p>
				<p>
					<label >Valor Unitario</label>
					<input type="text " id="vlr_unitario"  value="<?php if(isset($_GET['id'])){ echo $vlr_unitario; }?>" name="vlr_unitario">
				</p>
				<p>
					<input type="submit" name="enviar" value="Enviar" class="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Limpar" class="button">
				</p>
				<a href="../index.php">Página Inicial</a>
</html>
<?php
if(isset($_GET['id'])){
	if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
		$nome_item2	 =	$_POST['nome_item'];
		$vlr_unitario2	 =	$_POST['vlr_unitario'];
		//armazena qual é o campo do bd e qual é a variavel que faz referencia, facilita pra nao ficar escrevendo a query, ele utiliza a funcao inclusaobd que esta na pasta funcoes/funcoesbd
		$campos=array
		(
			'vlr_unitario' 	   => $vlr_unitario2,
			'nome_item'    		   => $nome_item2	 								  
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$condicao = "where id_item = $id";
		$sucesso  = alteracaobd("item", $campos, $condicao);
		if($sucesso){
			header("location: ../consulta/itens.php?alterado=true");
		}else{
			header("location: ../consulta/itens.php?alterado=false");	
		}
	}

}else{
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
					header("location: ../consulta/itens.php?incluido=true");
			}else{
					header("location: ../consulta/itens.php?incluido=false");		
			}
		}
	}
}

?>