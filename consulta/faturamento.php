<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>

	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_faturamento.php"; ?>
			<ul>
		</div>
	
	<?php if($permissao_sessao==0){ ?>
		<form action="faturamento_calcular.php" class="form" name="fat" method="POST">
		<div class="area_de_tabelas">
			<label for="data">Periodo Inicial</label><input type="date" name="data" id="data" value="<?php echo date("Y-m-d"); ?>" >
			<br />
			<label for="data2">Periodo final</label><input type="date" name="data2" id="data2" value="<?php echo date("Y-m-d"); ?>" >
				<br>
				
	<?php }else{
				echo '<div class="msg_erro">Você não tem permissão para ver o Faturamento</div>';

	} ?>	
		
		
		
		
	
	
		<?php
		if(isset($_GET['faturamento'])){
			$faturamento=$_GET['faturamento'];
			
			if($faturamento=='true'){
					// <div class="msg_sucesso">Não há msg de sucesso neste caso</div>
				}else{
				?>
					<br/><div class="msg_erro">Não há nenhum registro para este período.</div>
				<?php
				}
			}
		?>
		
		
		
		
		
		
	
		</div>
		
			<?php 
			if($permissao_sessao==0){
				include $_SERVER['DOCUMENT_ROOT'] . "/includes/bt_consultar.php";		
			}?>
		</form>	
	
	
	</body>
</html>
