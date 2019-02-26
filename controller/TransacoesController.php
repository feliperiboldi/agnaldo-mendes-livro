<?php
require_once ROOT_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'TransacoesService.php';


class TransacoesController
{

	private $transacoesService = null;

	
		public function __construct()
	{
		$this->transacoesService = new TransacoesService();
	}

	public function redirect($location)
	{
		header('Location: ' . $location);
	}

	public function handleRequest()
	{
		$op = isset($_GET['op']) ? $_GET['op'] : null;

		try {

			if (!$op || $op == 'list') {
				$this->listTransacoes();
			} elseif ($op == 'new') {
				$this->saveTransacao();
			} elseif ($op == 'edit') {
				$this->editTransacao();
			} elseif ($op == 'delete') {
				$this->deleteTransacao();
			} elseif ($op == 'show') {
				$this->showTransacao();
			} else {
				$this->showError("Page not found", "Page for operation " . $op . " was not found!");
			}
		} catch(Exception $e) {
			$this->showError("Application error", $e->getMessage());
		}
	}

	public function listTransacoes()
	{
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
		$transacoes = $this->transacoesService->getAllTransacoes($orderby);
		$saldo = $this->transacoesService->getSaldo();
		include ROOT_PATH . '../view/transacoes.php';

	}

	public function saveTransacao()
	{
		$title = 'Adicionar nova Transação';

		$descricao = '';
		$empresa = '';
		$valor = '';
		$tipo = '';
		$dtTransacao = '';

		$errors = array();

		if (isset($_POST['form-submitted'])) {

			$descricao 	 = isset($_POST['descricao']) 	? trim($_POST['descricao']) 	  : null;
			$empresa  	 = isset($_POST['empresa']) 	? trim($_POST['empresa'])   : null;
			$valor  	 = isset($_POST['valor']) 	? trim($_POST['valor'])   
					: null;
			$tipo  	 	 = isset($_POST['tipo']) 	? trim($_POST['tipo'])   
					: null;
			$dtTransacao = isset($_POST['dtTransacao']) 	? trim($_POST['dtTransacao'])   
					 : null;

			$valor = preg_replace("/[^0-9,]+/i","", $valor);
			$valor = str_replace(",",".", $valor);

			if(intval($tipo) === 0) {
				$valor = '-'.$valor;
			}

			try {
				$this->transacoesService->createNewTransacao($descricao, $empresa, $valor, $tipo, $dtTransacao);
				$this->redirect('index.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}

		include ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'transacao-form.php';
	}

	public function editTransacao()
	{
		$title  = "Ediar Transação";

		$descricao = '';
		$empresa = '';
		$valor = '';
		$tipo = '';
		$dtTransacao = '';
		$id = $_GET['id'];

		$errors = array();

		$transacao = $this->transacoesService->getTransacao($id);

		if (isset($_POST['form-submitted'])) {

			$descricao 	 = isset($_POST['descricao']) 	? trim($_POST['descricao']) 	  : null;
			$empresa  	 = isset($_POST['empresa']) 	? trim($_POST['empresa'])   : null;
			$valor  	 = isset($_POST['valor']) 	? trim($_POST['valor'])   
					: null;
			$tipo  	 	 = isset($_POST['tipo']) 	? trim($_POST['tipo'])   
					: null;
			$dtTransacao = isset($_POST['dtTransacao']) 	? trim($_POST['dtTransacao'])   
					 : null;

			$valor = preg_replace("/[^0-9,]+/i","", $valor);
			$valor = str_replace(",",".", $valor);

			if(intval($tipo) === 0) {
				$valor = '-'.$valor;
			}

			try {
				$this->transacoesService->editTransacao($descricao, $empresa, $valor, $tipo, $dtTransacao, $id);
				$this->redirect('index.php');
				return;
			} catch(ValidationException $e) {
				$errors = $e->getErrors();
			}
		}
		// Include in the view of the edit form
		include ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'transacao-form-edit.php';
	}

	public function deleteTransacao()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;
			if (!$id) {
				throw new Exception('Internal error');
			}
			$this->transacoesService->deleteTransacao($id);

			$this->redirect('index.php');
	}

	public function showTransacao()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : null;

		$errors = array();

		if (!$id) {
			throw new Exception('Internal error');
		}
		$evento = $this->transacoesService->getEvento($id);

		include ROOT_PATH.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.'evento.php';
	}

	public static function converteMoeda($get_valor) 
	{
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor);
        return $valor; 
    }

	public function showError($title, $message)
	{
		include ROOT_PATH . 'view/error.php';
	}
}

?>
