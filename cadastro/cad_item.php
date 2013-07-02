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
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a href='itens.php' class="desabilitar_link fundo_2" data-titulo="itens"><i class="itens"></i>Itens</a></li>
								<li><a class="desabilitar_link fundo_6" data-titulo="item" ><i class="incluir"></i>Incluir/Alterar Item</a></li>
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
			
				<button class="fundo_1"  value="Enviar" name="enviar" type="submit"><i class='incluir'></i>Salvar</button>
				<a href="javascript:window.history.go(-1)" class="fundo_8"><i class='cancelar'></i>Cancelar</a>
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