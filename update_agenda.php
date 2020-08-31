<?php
	require_once 'conn.php';
	
		$agenda_id = $_POST['agenda_id'];
		$nome = $_POST['nome_altera_'.$agenda_id];
		$descricao = $_POST['descricao_altera_'.$agenda_id];
		$data = $_POST['data_altera_'.$agenda_id];
		$hora_ini = $_POST['hora_ini_altera_'.$agenda_id];
		$hora_fim = $_POST['hora_fim_altera_'.$agenda_id];
		$local = $_POST['local_altera_'.$agenda_id];
		$participantes = $_POST['participantes_altera_'.$agenda_id];
		$tipo = $_POST['tipo_altera_'.$agenda_id];
		
		$query = "UPDATE `agenda` SET `nome` = :nome, `descricao` = :descricao, `data_cri` = :data_cri, `hora_ini` = :hora_ini, `hora_fim` = :hora_fim, `local_evento` = :local_evento, `participantes` = :participantes, `tipo` = :tipo  WHERE `agenda_id` = :agenda_id";
		
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':descricao', $descricao);
		$stmt->bindParam(':data_cri', $data);
		$stmt->bindParam(':hora_ini', $hora_ini);
		$stmt->bindParam(':hora_fim', $hora_fim);
		$stmt->bindParam(':local_evento', $local);
		$stmt->bindParam(':participantes', $participantes);
		$stmt->bindParam(':tipo', $tipo);
		$stmt->bindParam(':agenda_id', $agenda_id);
		
		$stmt->execute();
		$conn = null;
		
		header('location: dashboard.php');
	
?>