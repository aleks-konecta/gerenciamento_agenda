<?php
	require_once 'conn.php';
	
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$data = $_POST['data'];
		$hora_ini = $_POST['hora_ini'];
		$hora_fim = $_POST['hora_fim'];
		$local = $_POST['local'];
		$participantes = $_POST['participantes'];
		$tipo = $_POST['tipo'];
		
		$query = "INSERT INTO agenda(nome, descricao, data_cri, hora_ini, hora_fim, local_evento, participantes, tipo) VALUES(:nome, :descricao, :data_cri, :hora_ini, :hora_fim, :local_evento, :participantes, :tipo)";
		
		$stmt = $conn->prepare($query);
		$stmt->bindValue(':nome', $nome);
		$stmt->bindValue(':descricao', $descricao);
		$stmt->bindValue(':data_cri', $data);
		$stmt->bindValue(':hora_ini', $hora_ini);
		$stmt->bindValue(':hora_fim', $hora_fim);
		$stmt->bindValue(':local_evento', $local);
		$stmt->bindValue(':participantes', $participantes);
		$stmt->bindValue(':tipo', $tipo);
		//var_dump($stmt);

		$stmt->execute();
		
		//exit();
		$conn = null;
		
		header('location: dashboard.php');
	
?>