<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id	=	$_GET['id'];

$query			 =	mysql_query("Select nome_item,vlr_unitario from item where id_item = $id");
$dados 			 = 	mysql_fetch_array($query);
//busca os dados pelo id e depois armazena na variavel
$nome_item		 =	$dados['nome_item'];
$vlr_unitario	 =	$dados['vlr_unitario'];

if ((isset($_POST['Alterar'])) && ($_POST['Alterar'] == 'Alterar')){
	$cont_erro == 0;
}
?>
<html>
	<form name="alterar_itens" method="POST" action="alt_item.php?id=<?php echo $id; ?>">
		<fieldset>
			<legend>ALTERAR  ITENS</legend>
				<p>
					<label>Nome Item</label>
	
					<input type="text" id="nome_item" maxlength="50" required value='<?php echo $nome_item; ?>' name="nome_item">
				</p>
				<p>
					<label >Valor Unitario</label>
						<?php
						
						if ((isset($_POST['Alterar'])) && ($_POST['Alterar'] == 'Alterar')){
							if($vlr_unitario == ""){
								 echo "Informe o valor Unitario"; 
								 $cont_erro++;
							}
						} ?>
					<input type="text" id="vlr_unitario"  required value="<?php echo $vlr_unitario;?>" name="vlr_unitario">
				</p>
				<p>
					<input type="submit" name="Alterar" value="Alterar" class="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Limpar" class="button">
				</p>
				<a href="../consulta/funcionarios.php">Voltar</a>
</html>
<?php
if ((isset($_POST['Alterar'])) && ($_POST['Alterar'] == 'Alterar')){
	if($cont_erro == 0)
	{
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
			echo "Registro Alterado";
			header("location: ../consulta/itens.php ");
		}else{
			echo "Erro ao Alterar";
		}
	}
}

?>