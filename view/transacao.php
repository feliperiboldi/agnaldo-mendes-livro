<?php require_once "header.php"; ?>

<h1><?php echo $evento->nome; ?></h1>
<div>
    <span class="label">Número de Vagas:</span>
    <?php echo $evento->numero; ?>
</div>

<?php require_once "footer.php"; ?>