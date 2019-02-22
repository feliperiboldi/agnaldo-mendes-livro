<?php require_once "header.php"; ?>

<div class="container">
	<h3>Agnaldo Mendes</h3>
	<div><a class="btn btn-secondary" href="index.php?op=new">Nova Transação</a></div><br>
	<table class="table table-hover table-bordered table-stripped table-transacoes" border="0" cellpadding="0" cellspacing="0" style="margin-top: 50px;">
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
			
		<tbody>
			<?php foreach ($transacoes as $transacao) : ?>
			<?php if($transacao->tipo === 1) {
				$tipo = "Crédito";
			} else {
				$tipo = "Débito";
			} ?>
			<tr>	
				<td><a href="index.php?op=show&id=<?php echo $evento->id; ?>"><?php echo htmlentities($transacao->id); ?></a></td>
				<td><?php echo htmlentities($transacao->descricao); ?></td>
				<td><?php echo htmlentities($transacao->empresa); ?></td>
				<td><?php echo htmlentities($transacao->valor); ?></td>
				<td><?php echo htmlentities($tipo); ?></td>
				<td><?php echo htmlentities($transacao->dtTransacao); ?></td>
				<td>
					<a href="index.php?op=edit&id=<?php echo $evento->id; ?>">
						<i class="fa fa-pencil-square-o"></i>
					</a>
				</td>
				<td>
					<a href="index.php?op=delete&id=<?php echo $evento->id; ?>" onclick="return confirm('Você tem certeza que quer deletar?');" style="color: red;">
						<i class="fa fa-trash-o"></i>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>		
	</table>
</div>

<?php require_once "footer.php" ?>