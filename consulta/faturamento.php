<html>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/head.php"; ?>
	
	<body>

	
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a href='/menu.php' class="fe_titulo desabilitar_link voltar_para_menu" data-titulo="menu"><i class="menu"></i>Menu Principal</a></li>
				<li><a class="desabilitar_link fundo_6" data-titulo="faturamento"><i class="faturamento"></i>Faturamento</a></li>
			<ul>
		</div>
	
	
		<form action="faturamento_calcular.php" class="form" name="fat" method="POST">
		<div class="area_de_tabelas">
			<label for="data">Periodo Inicial</label><input type="date" name="data" id="data" value="<?php echo date("Y-m-d"); ?>" >
			<br />
			<label for="data2">Periodo final</label><input type="date" name="data2" id="data2" value="<?php echo date("Y-m-d"); ?>" >
				<br>
				
		
		
		
		
		
	
	
		<?php
		if(isset($_GET['excluido'])){
			$excluido=$_GET['excluido'];
			
			if($excluido=='true'){
					// <div class="msg_sucesso">Não há msg de sucesso neste caso</div>
				}else{
				?>
					<br/><div class="msg_erro">Não há nenhum registro para este período.</div>
				<?php
				}
			}
		?>
		
		
		
		
		
		
	
		</div>
		<button class="fundo_8" type="submit"><i class='consultar'></i>Consultar</button>
		</form>	
	
	
	</body>
</html>
