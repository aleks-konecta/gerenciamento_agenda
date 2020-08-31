<?php
	try {
		$conn = new PDO('sqlite:db/db_agenda.sqlite3');
	
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		$query = "CREATE TABLE IF NOT EXISTS agenda (agenda_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome TEXT, descricao TEXT, data_cri NUMERIC, local_evento TEXT, participantes TEXT)";
	
		//var_dump($conn->exec($query));



	} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
	}

	//exit();
?>