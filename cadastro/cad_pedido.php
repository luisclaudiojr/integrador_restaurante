<?php		
ob_start();
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id_conta   = $_GET['id_conta'];
$sql_mesa   = "SELECT nro_mesa FROM conta inner join mesa ON (conta.MESA_id_mesa=mesa.id_mesa)where id_conta=$id_conta";
$resultado  = mysql_query($sql_mesa);
$linha 		= mysql_fetch_array($resultado);
$nro_mesa  = $linha["nro_mesa"];
					
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$id_item2 		= $_POST['item'];
	$qtd		  	= $_POST['qtd'];
	$descricao	  	= $_POST['descricao'];
	$data_pedido  	= date("Y-m-d H:i:s");
	$cont_erro 		= 0;
}
?>
<html>
	
	
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_3" data-titulo="contas" href="/consulta/contas.php"><i class="contas"></i>Contas em Aberto</a></li>
				<li><a class="desabilitar_link fundo_4" data-titulo="pedido" "><i class="itens"></i>Cadastro de pedido na conta<?php echo $id_conta;?> (mesa: <?php echo $nro_mesa; ?>)</a></li>
			<ul>
		</div>
	
	
		
	
	<form class="form" name="cadastro_contas" method="POST" action="cad_pedido.php?id_conta=<?php echo $id_conta; ?>">
	<div class="area_de_tabelas">
	

	
	
<?php
	if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
	if($cont_erro == 0)
	{
		//status pedido  P= pendente  E=Encerrado
		//armazena qual é o campo do bd e qual é a variavel que faz referencia, facilita pra nao ficar escrevendo a query, ele utiliza a funcao inclusaobd que esta na pasta funcoes/funcoesbd
		$campos=array
		(
			'data_pedido' 	   				 => $data_pedido,
			'CONTA_id_conta'     			 => $id_conta,
			'status_pedido'   			     => 'P',
			'qtd' 	   				 		 => $qtd,
			'ITEM_id_item'     				 => $id_item2,
			'descricao_pedido'     				 => $descricao			
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$sucesso = inclusaobd("pedido",$campos);	
			
		if($sucesso){
				?> <div class="msg_sucesso">Registro excluido.</div> <?php
				//header("Location: ../cadastro/cad_pedido.php?id=$id_conta_final");
		}else{
			?> <div class="msg_erro">Erro ao inserir.</div> <?php
		}
		
		echo "<br />";
	}
}

?>
	
	
	
		<label id="labelcentro">item:</label>
				<?php
				if ((isset($_POST['Enviar'])) && ($_POST['Enviar'] == 'Enviar')){
						if($item==""){
							echo "<span id='error'><img src='imagens/erroricon.gif' height='12'> Informe o item</span>";
							$cont_erro++; 
							}
					}?>
				<select name='item' id='item'>
				<option value="">--item--</option>
				<?php
					   $sql = "SELECT * FROM item  ";
					   $res = mysql_query($sql) or die ("Erro: ".mysql_error());
					   //cria a variavel
						$registro = "";
						while ($linha  = mysql_fetch_array($res, MYSQL_ASSOC)){
						   $nome_item  = $linha["nome_item"];
						   $id_item    = $linha["id_item"];
							echo "<option value=$id_item>$nome_item</option>";
						}		
				?>						 
				</select>
			<br />
			<label>Quantidade</label>
				<?php
				
				if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
					if($qtd == ""){
						echo "Informe a Quantidade"; 
						$cont_erro++;
					}
				} ?>
				
				<input type="text" id="nome_func" maxlength="3" required value='<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $qtd ;}?>' name="qtd">
			<br />
			<label>Descrição:</label>
			<textarea name='descricao' ></textarea>
		</div>
			<button class="fundo_1"  value="Enviar" name="enviar" type="submit"><i class='incluir'></i>Salvar</button>
			<a href="/consulta/funcionarios.php" class="fundo_8"><i class='cancelar'></i>Cancelar</a>
		
		</form>


</html>
