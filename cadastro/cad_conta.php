<?php		
@session_start();
ob_start();
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id_funcionario = $_SESSION['id_funcionario'];
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$id_mesa2	  	= $_POST['mesa'];
	$data_entrada  	= date("Y-m-d H:i:s");
	$cont_erro 		= 0;
}
?>
<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_contas.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_cadastrar_alterar.php"; ?>
			<ul>
		</div>

		
	
	
	<form name="cadastro_contas" class="form" method="POST" action="cad_conta.php">
	<div class="area_de_tabelas">

			<br />
			<label for="mesa" id="labelcentro">Mesa:</label>
				<select name='mesa' id='mesa'>
				<option value="">--MESA--</option>
				<?php
					   $sql = "SELECT * FROM  MESA where status='L'";
					   $res = mysql_query($sql) or die ("Erro: ".mysql_error());
					   
						$registro="";
						while ($linha = mysql_fetch_array($res, MYSQL_ASSOC)){
						   $nro_mesa  = $linha["nro_mesa"];
						   $id_mesa   = $linha["id_mesa"];
							echo "<option value='".$id_mesa."'";
							
							echo ">".$nro_mesa."</option>";  	
						}		
				?>						 
				</select>

			</div>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_salvar_cancelar.php"; ?>
			</form>
</html>
<?php
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
	if($cont_erro == 0)
	{
		//armazena qual é o campo do bd e qual é a variavel que faz referencia, facilita pra nao ficar escrevendo a query, ele utiliza a funcao inclusaobd que esta na pasta funcoes/funcoesbd
		$campos=array
		(
			'data_entrada' 	   				 => $data_entrada,
			'FUNCIONARIO_id_funcionario'     =>  $id_funcionario,
			'status_conta'   			     => 'A',
			'MESA_id_mesa'					 => $id_mesa2 								  
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$sucesso = inclusaobd("conta",$campos);	
		$campos2=array
		(
			'status' 	   				 => 'O'								  
		);
		$where = "where id_mesa=$id_mesa2";
		
		if($sucesso){
		
			$alt_pos_mesa  = alteracaobd("mesa",$campos2,$where);	
			//pega o ultimo registro inserido e redireciona pra pagina de pedidos para lançar os pedidos nessa conta
			$query_conta="SELECT id_conta FROM conta ORDER BY id_conta DESC LIMIT 1";
			$executar_query=mysql_query($query_conta);
			$linha2=mysql_fetch_array($executar_query);
			$id_conta_final=$linha2['id_conta'];
	
				header("Location: ../cadastro/cad_pedido.php?id_conta=$id_conta_final");
		}else{
			echo "Erro ao Inserir";
		}
	}
}

?>