<?php		
ob_start();
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$id_funcionario = $_POST['funcionario'];
	$id_mesa2	  	= $_POST['mesa'];
	$data_entrada  	= date("Y-m-d H:i:s");
	$cont_erro 		= 0;
}
?>
<html>
	<form name="cadastro_contas" method="POST" action="cad_conta.php">
		<fieldset>
			<legend>CADASTRO DE CONTAS</legend>
			<p><label id="labelcentro">Funcionário:</label>
				<?php
				if ((isset($_POST['Enviar'])) && ($_POST['Enviar'] == 'Enviar')){
						if($funcionario==""){
							echo "<span id='error'><img src='imagens/erroricon.gif' height='12'> Informe o Funcionario</span>";
							$cont_erro++; 
							}
					}?>
				<select name='funcionario' id='funcionario'>
				<option value="">--Funcionario--</option>
				<?php
					   $sql = "SELECT * FROM funcionario ORDER BY nome_funcionario";
					   $res = mysql_query($sql) or die ("Erro: ".mysql_error());
						$registro="";
						while ($linha = mysql_fetch_array($res, MYSQL_ASSOC)){
						   
							echo "<option value='".$linha["id_funcionario"]."'";
							
							echo ">".$linha["nome_funcionario"]."</option>";  	
						}
											
				?>						 
			   </select>
			</p>
			<p><label id="labelcentro">Mesa:</label>
				<?php
				if ((isset($_POST['Enviar'])) && ($_POST['Enviar'] == 'Enviar')){
						if($mesa==""){
							echo "<span id='error'><img src='imagens/erroricon.gif' height='12'> Informe a Mesa</span>";
							$cont_erro++; 
							}
					}?>
				<select name='mesa' id='mesa'>
				<option value="">--MESA--</option>
				<?php
					   $sql = "SELECT * FROM CONTA INNER JOIN MESA on (CONTA.MESA_ID_MESA=mesa.id_mesa) where exists (SELECT * FROM MESA)  GROUP BY ID_CONTA";
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
			'data_entrada' 	   				 => $data_entrada,
			'FUNCIONARIO_id_funcionario'     => $id_funcionario,
			'status_conta'   			     => 'A',
			'MESA_id_mesa'					 => $id_mesa2 								  
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$sucesso = inclusaobd("conta",$campos);	
		if($sucesso){
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