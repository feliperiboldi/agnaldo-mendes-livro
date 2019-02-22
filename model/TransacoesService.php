<?php

require_once ROOT_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'TransacoesGateway.php';
require_once ROOT_PATH.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.'Database.php';

class TransacoesService extends TransacoesGateway
{

	private $transacoesGateway = null;

	public function __construct()
	{
		$this->transacoesGateway = new TransacoesGateway();
	}

	public function getAllTransacoes($order) { 
	    try { 
	        self::connect();
	        $res = $this->transacoesGateway->selectAll($order); 
	        self::disconnect();
	        return $res; 
	    } catch (Exception $e) { 
	        self::disconnect();
	        throw $e; 
	    } 
	} 

	public function getTransacao($id) 
	{
		try {
			self::connect();
			$result = $this->transacoesGateway->selectById($id);
			self::disconnect();
			return $result;
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
		return $this->transacoesGateway->selectById($id);
	}

	public function createNewTransacao($descricao, $empresa, $valor, $tipo, $dtTransacao)
	{
		try {
			self::connect();
			$result = $this->transacoesGateway->insert($descricao, $empresa, $valor, $tipo, $dtTransacao);
			self::disconnect();
			return $result;
		} catch(Exception $e) {
			self::disconnect();
			throw $e;

		}
	}

	public function editTransaca($nome, $numero, $id)
	{
		try {
			self::connect();
			$result = $this->transacoesGateway->edit($nome, $numero, $id);
			self::disconnect();
		}catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}

	public function deleteTransaca($id)
	{
		try {
			self::connect();
			$result = $this->transacoesGateway->delete($id);
			self::disconnect();
		} catch(Exception $e) {
			self::disconnect();
			throw $e;
		}
	}
}

?>
