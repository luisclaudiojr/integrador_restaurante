<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

$id	=	$_GET['id'];

$query			 =	 mysql_query("Select nome_funcionario,data_admissao from funcionario where id_funcionario=$id");
$dados 			 = 	mysql_fetch_array($query);
//busca os dados pelo id e depois armazena na variavel
$nomefunc		 =	$dados['nome_funcionario'];
$data_admissao	 =	$dados['data_admissao'];
//transformando em data
$data_admissao	 =	date("Y-m-d", strtotime($data_admissao));
if ((isset($_POST['Alterar'])) && ($_POST['Alterar'] == 'Alterar')){
		$cont_erro == 0;
}
?>
<html>
	<form name="alterar_funcionario" method="POST" action="alt_func.php?id=<?php echo $id; ?>">
		<fieldset>
			<legend>ALTERAR  FUNCIONARIOS</legend>
				<p>
					<label>Nome</label>
					<?php
					
					if ((isset($_POST['Alterar'])) && ($_POST['Alterar'] == 'Alterar')){
						if($nomefunc == ""){
							 echo "Informe o nome do funcionario"; 
							$cont_erro++;
						}
					} ?>
					
					<input type="text" id="nome_func" maxlength="50" required value='<?php echo $nomefunc; ?>' name="txtnome">
				</p>
				<p>
					<label >Data de Admissão</label>
						<?php
						
						if ((isset($_POST['Alterar'])) && ($_POST['Alterar'] == 'Alterar')){
							if($data_admissao == ""){
								 echo "Informe a data de Admissão"; 
								 $cont_erro++;
							}
						} ?>
					<input type="date" id="data_admissao"  required value="<?php echo $data_admissao;?>" name="data_admissao">
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
		$nomefunc2		 =	$_POST['txtnome'];
		$data_admissao2	 =	$_POST['data_admissao'];
		//armazena qual é o campo do bd e qual é a variavel que faz referencia, facilita pra nao ficar escrevendo a query, ele utiliza a funcao inclusaobd que esta na pasta funcoes/funcoesbd
		$campos=array
		(
			'data_admissao' 	   => $data_admissao2,
			'nome_funcionario'     => $nomefunc2	 								  
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$condicao = "where id_funcionario = $id";
		$sucesso  = alteracaobd("funcionario", $campos, $condicao);
		if($sucesso){
			echo "Registro Alterado";
			header("location: ../consulta/funcionarios.php ");
		}else{
			echo "Erro ao Alterar";
		}
	}
}

?>