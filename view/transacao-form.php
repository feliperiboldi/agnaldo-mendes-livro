<?php require_once "header.php"; ?>

<div class="container">
	<h3>Adicionar Transação</h3>
</div>

<?php
	if ($errors) {
			echo '<ul class="errors">';
		foreach ($errors as $field => $error) {
			echo '<li>' . htmlentities($error) . '</li>';
		}
		echo '</ul>';
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<form method="post" action="">
				<div class="form-group">
					<label for="descricao">Descrição: </label><br>
					<textarea cols="8" rows="08" class="form-control" name="descricao" value="<?php echo htmlentities($descricao); ?>" placeholder="Digite a Descrição"></textarea>
				</div>

				<div class="form-group">
					<label for="empresa">Empresa: </label><br>
					<input type="text" class="form-control" name="empresa" value="<?php echo htmlentities($empresa); ?>" placeholder="Digite a Empresa">
				</div>

				<div class="form-group">
					<label for="valor">Valor: </label><br>
					<input type="text" class="form-control" id="valor" name="valor" value="<?php echo htmlentities($valor); ?>" placeholder="Digite o Valor" onKeyPress="return(moeda(this,'.',',',event))"> 
				</div>

				<div class="form-group">
					<label class="radio-inline">
						<input type="radio" name="tipo" value="1">
						Crédito
					</label>
					<label class="radio-inline">
						<input type="radio" name="tipo" value="0">
						Débito
					</label>
				</div>

				<div class="form-group">
					<label for="dtTransacao">Data da Transação: </label><br>
					<input type="date" class="form-control" name="dtTransacao" value="<?php echo htmlentities($dtTransacao); ?>" placeholder="Digite a Empresa">
				</div>

				<div class="form-group">
					<input type="hidden" name="form-submitted" value="1">
					<button type="submit" class="btn btn-primary">Enviar</button>
					<button type="button" class="btn btn-danger" onclick="location.href='index.php'">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>		

<?php require_once "footer.php"; ?>