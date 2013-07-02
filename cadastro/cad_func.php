<?php		
include "../conexao.php";
include "../funcoes/funcoesbd/funcoesbd.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query			 =	 mysql_query("Select nome_funcionario,data_admissao from funcionario where id_funcionario=$id");
	$dados 			 = 	mysql_fetch_array($query);
	//busca os dados pelo id e depois armazena na variavel
	$nomefunc		 =	$dados['nome_funcionario'];
	$data_admissao	 =	$dados['data_admissao'];
	//transformando em data
	$data_admissao	 =	date("Y-m-d", strtotime($data_admissao));
}
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){

	$nomefunc 		= $_POST['txtnome'];
	$data_admissao  = $_POST['data_admissao'];
}
?>
<html>
<?php
if(isset($_GET['id'])){
//se houve a passada de um id ele vai realizar a alteração
	$action="cad_func.php?id=$id";
}else{
	$action="cad_func.php";
}	
	?>
	<form name="cadastro_funcionario" method="POST" action="<?php echo $action;?>">
	<fieldset>
			<legend>CADASTRO DE FUNCIONARIOS</legend>
				<p>
					<label>Nome</label>			
					<input type="text" id="nome_func" maxlength="50" required value='<?php  if (isset($_GET['id'])){ echo $nomefunc; }?>' name="txtnome">
				</p>
				<p>
					<label >Data de Admissão</label>
					<input type="date" id="data_admissao"  value="<?php  if (isset($_GET['id'])){ echo $data_admissao; }?>" name="data_admissao">
				</p>
				<p>
					<input type="submit" name="enviar" value="Enviar" class="button">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="reset" value="Limpar" class="button">
				</p>
				<a href="/consulta/funcionarios.php">Cancelar</a>
</html>
<?php
//se cair aqui é porque é alteracao
if(isset($_GET['id'])){
	if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
		
		$campos=array
		(
			'data_admissao' 	   => $data_admissao,
			'nome_funcionario'     => $nomefunc	 								  
		);
		$condicao = " where id_funcionario=$id";
		$sucesso = alteracaobd("funcionario",$campos,$condicao);	
	}
}
//se não é apenas inclusao
else{
//se for setado algo e não haver o ID é inclusao
if ((isset($_POST['enviar'])) && ($_POST['enviar'] == 'Enviar')){
	
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