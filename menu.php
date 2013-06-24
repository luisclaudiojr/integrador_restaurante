<html>
	<?php include "/includes/head.php"; ?>
	<body>
		<div id='menu' class="fe_menu_index">
			<ul>
				<li><a class="fe_titulo desabilitar_link" data-titulo="menu" href="/menu.php"><i class="menu"></i>MENU DE NAVEGAÇÃO</a></li>
				<li><a class="desabilitar_link" data-titulo="funcionarios" href="/consulta/funcionarios.php"><i class="funcionarios"></i>Funcionarios</a></li><!-- AQUI ALTERA OS DADOS DO FUNCIONARIO,EXCLUI  E CADASTRA  -->
				<li><a class="desabilitar_link" data-titulo="contas" href="/consulta/contas.php"><i class="contas"></i>Contas</a></li> <!-- AQUI ALTERA O STATUS, FAZ O FECHAMENTO DA CONTA! ADICIONO MAIS PEDIDOS NA CONTA -->
				<li><a class="desabilitar_link" data-titulo="itens" href="/consulta/itens.php"><i class="itens"></i>Itens</a></li> <!-- AQUI ALTERA OS ITENS, E CADASTRA !  -->
				<li><a class="desabilitar_link" data-titulo="mesas" href="/consulta/mesas.php"><i class="mesas"></i>Mesas</a></li> <!-- AQUI ALTERA AS MESAS, E CADASTRA !  -->
				<li><a class="desabilitar_link" data-titulo="faturamento" href="/consulta/faturamento.php"><i class="faturamento"></i>Faturamento</a></li><!-- FATURAMENTO PELO PERIODO EMITE O RELATORIO  DO PERIODO -->
				<li><a class="desabilitar_link" data-titulo="pendencias" disabled="disabled" href="/consulta/pedidos_pendentes.php"><i class="pendencias"></i>pendências</a></li><!-- PENDENCIAS - MOSTRA PEDIDO - QTD E MESA - POR ORDEM DE DATA -->
			<ul>
		</div>
	</body>
</html>