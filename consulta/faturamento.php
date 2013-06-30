<html>
	
	<?php /* <head> ============== */ include "/includes/head.php"; ?>
	
	<body>
		<form action="faturamento_calcular.php"  name="fat" method="POST">
			       <fieldset class="label_side">
						<legend> FATURAMENTO </legend>
			          <label>Defina a data do faturamento.</label>
						      	<input type="date" name="data" id="data" > <label>&nbsp;&nbsp; A</label> <input type="date" name="data2" id="data2" >
									<br>
								<input type="submit" class="button blue small" value="ENVIAR"  align="right" >
        
					</fieldset>
	    	   
		<a href='/menu.php' class="desabilitar_link voltar_para_menu" data-titulo="menu">Voltar</a>
		</form>				
		
	
	</body>
</html>
