<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$nomefunc 		= $_POST['txtnome'];
	$data_admissao  = $_POST['data_admissao'];
	$cont_erro 		= 0;
}
?>
<html>
	<form name="cadastro_funcionario" method="POST" action="cad_func.php">
		<fieldset>
			<legend>CADASTRO DE FUNCIONARIOS</legend>
				<p>
					<label>Nome</label>
					<?php
					
					if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
						if($nomefunc == ""){
							echo "Informe o nome do funcionario"; 
							$cont_erro++;
						}
					} ?>
					
					<input type="text" id="nome_func" maxlength="50" required value='<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $nomefunc ;}?>' name="txtnome">
				</p>
				<p>
					<label >Data de Admissão</label>
						<?php
						
						if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
							if($data_admissao == ""){
								echo "Informe a data de Admissão"; 
								$cont_erro++;
							}
						} ?>
					<input type="date" id="data_admissao"  value="<?php if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){ echo $data_admissao; }?>" name="data_admissao">
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
			'data_admissao' 	   => $data_admissao,
			'nome_funcionario'     => $nomefunc	 								  
		);
		//passa qual é a tabela pois a função está esperando pela tabela e pelos campos
		$sucesso = inclusaobd("funcionario",$campos);	
		if($sucesso){
			echo "Registro Inserido";
		}else{
			echo "Erro ao Inserir";
		}
	}
}

?>