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
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_itens.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_cadastrar_alterar.php"; ?>
			<ul>
		</div>
	
	<form class="form" name="cadastro_item" method="POST" action="<?php echo $action;?>">
		<div class="area_de_tabelas">
					<label for="nome_item">Nome Item</label>					
					<input type="text" id="nome_item" maxlength="50" required value='<?php if(isset($_GET['id'])){ echo $nome_item ;}?>' name="nome_item">
				<br />
					<label for="vlr_unitario">Valor Unitario</label>
					<input type="text " id="vlr_unitario"  value="<?php if(isset($_GET['id'])){ echo $vlr_unitario; }?>" name="vlr_unitario">
			
			</div>
			
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_salvar_cancelar.php"; ?>
			</form>
				
				
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