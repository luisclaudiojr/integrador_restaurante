<?php
		//trata para ver se foi excluido
		if(isset($_GET['excluido'])){
			$excluido=$_GET['excluido'];	
			if($excluido=='true'){
				?>
					<div class="msg_sucesso">Registro excluido.</div>
				<?php
				}else{
				?>
					<div class="msg_erro">Não foi Possivel Excluir Registro,Verifique se ele ja possui algum registro que faça uso dele.</div>
				<?php
				}
			}
			if(isset($_GET['alterado'])){
				$alterado=$_GET['alterado'];	
				if($alterado=='true'){
				?>
					<div class="msg_sucesso">Registro Alterado.</div>
				<?php
				}else{
				?>
					<div class="msg_erro">Ocorreu Algum erro ao Alterar o Registro.</div>
				<?php
				}
			}
			if(isset($_GET['incluido'])){
				$incluido=$_GET['incluido'];	
					if($incluido=='true'){
						?>
							<div class="msg_sucesso">Registro incluido com sucesso.</div>
						<?php
						}else{
						?>
							<div class="msg_erro">Ocorreu Algum erro ao Incluir o Registro.</div>
						<?php
						}
			}
			?>