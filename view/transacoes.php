<?php require_once "header.php"; ?>

<div class="container">
	<div><a class="btn btn-primary" href="index.php?op=new">Nova Transação</a></div><br>
	<table id="transacoes" class="table table-hover table-bordered table-stripped table-transacoes" border="0" cellpadding="0" cellspacing="0" style="margin-top: 50px;">
		<thead>
			<tr>
				<th><a href="?orderby=id">ID</a></th>
				<th><a href="?orderby=descricao">Descrição</a></th>
				<th><a href="?orderby=empresa">Empresa</a></th>
				<th><a href="?orderby=valor">Valor</a></th>
				<th><a href="?orderby=tipo">Tipo</a></th>
				<th><a href="?orderby=dtTransacao">Data</a></th>
				<th>&nbsp</th>
				<th>&nbsp</th>
			</tr>
		</thead>

		<?php if(count($transacoes) > 0) : ?>
		<tbody>
			<?php foreach ($transacoes as $transacao) : ?>
			<?php if(intval($transacao->tipo) === 1) {
				$tipo = "Crédito";
			} else {
				$tipo = "Débito";
			} 
			?>
			<tr>	
				<td><?php echo htmlentities($transacao->id); ?></td>
				<td><?php echo htmlentities($transacao->descricao); ?></td>
				<td><?php echo htmlentities($transacao->empresa); ?></td>
				<td><?php echo 'R$'.str_replace('-', '', $transacao->valor); ?></td>
				<td><?php echo htmlentities($tipo); ?></td>
				<td><?php echo date('d/m/Y', strtotime($transacao->dtTransacao)); ?></td>
				<td>
					<a href="index.php?op=edit&id=<?php echo $transacao->id; ?>">
						<i class="fa fa-pencil-square-o"></i>
					</a>
				</td>
				<td>
					<a href="index.php?op=delete&id=<?php echo $transacao->id; ?>" onclick="return confirm('Você tem certeza que quer deletar?');" style="color: red;">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<?php endif; ?>		
	</table>

	<?php

	$saldo = $saldo->saldo;

	$round = round($saldo, 2);
	$numero = number_format($round, 2, ',', '.');

	 ?>
	
	<div class="saldo-area">
		<?php if($numero == 0): ?>
		<div class="alert alert-info" role="alert">
  			Saldo neutro de: <strong>R$<?php echo $numero; ?></strong>
		</div>
		<?php endif; ?>

		<?php if($numero < 0): ?>
			<div class="alert alert-danger" role="alert">
	  			Saldo negativo de: <strong>R$<?php echo $numero; ?></strong>
			</div>
		<?php endif; ?>

		<?php if($numero > 0): ?>
			<div class="alert alert-success" role="alert">
	  			Saldo positivo de: <strong>R$<?php echo $numero; ?></strong>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php require_once "footer.php" ?>