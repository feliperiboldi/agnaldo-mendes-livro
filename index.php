<?php

define('ROOT_PATH', dirname(__FILE__));

require_once 'controller/TransacoesController.php';

require_once "view/header.php";

$controller = new TransacoesController();

$controller->handleRequest();

require_once "view/footer.php";

?>
