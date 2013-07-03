<html>
	<?php 
	include_once "/includes/valida_sessao.php";
	include "/includes/head.php"; ?>
	<body style="background: black;">
	
	

	
		<div id='menu' class="fe_menu_index">
			<ul>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_menu_principal.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_funcionarios.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_contas.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_itens.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_mesas.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_faturamento.php"; ?>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_pendencias.php"; ?>
				
			<ul>
		</div>
		
		<style>
			#menu ul li a { background-color: rgb(50,50,50); border-left-width: 5px; border-left-style: solid;  border-left-color: rgb(50,50,50)}
			#menu ul li a:hover { }
		</style>
		
		
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/titulo_logout.php"; ?>
		
	</body>
</html>