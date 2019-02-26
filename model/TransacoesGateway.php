<?php
require_once 'Database.php';

class TransacoesGateway extends Database 
{

	public function selectAll($order)
	{
		if (!isset($order)) {
			$order = 'dtTransacao';
		}
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM transacoes ORDER BY $order ASC");
		$sql->execute();
		// $result = $sql->fetchAll(PDO::FETCH_ASSOC);

		$transacoes = array();
		while ($obj = $sql->fetch(PDO::FETCH_OBJ)) {
		
			$transacoes[] = $obj;
		}
		return $transacoes;
	}

	public function selectById($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT * FROM transacoes WHERE id = ?");
		$sql->bindValue(1, $id);
		$sql->execute();
		$result = $sql->fetch(PDO::FETCH_OBJ);
		
		return $result;
	}

	public function selectValores()
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("SELECT SUM(valor) AS saldo FROM transacoes");
		$sql->execute();

		$result = $sql->fetch(PDO::FETCH_OBJ);

		return $result;
	}

	public function insert($descricao, $empresa, $valor, $tipo, $dtTransacao)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("INSERT INTO transacoes (descricao, empresa, valor, tipo, dtTransacao) VALUES (?, ?, ?, ?, ?)");
		$result = $sql->execute(array($descricao, $empresa, $valor, $tipo, $dtTransacao));
	}

	public function edit($descricao, $empresa, $valor, $tipo, $dtTransacao, $id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("UPDATE transacoes set descricao = ?, empresa = ?, valor = ?, tipo = ?, dtTransacao = ? WHERE id = ? LIMIT 1");
		$result = $sql->execute(array($descricao, $empresa, $valor, $tipo, $dtTransacao, $id));
	}

	public function delete($id)
	{
		$pdo = Database::connect();
		$sql = $pdo->prepare("DELETE FROM transacoes WHERE id = ?");
		$sql->execute(array($id));
	}
}

?>
