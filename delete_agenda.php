<?php
	require_once 'conn.php';

	print "<pre>";

	print $_REQUEST[id];
	
	if(ISSET($_REQUEST['id'])){
		$query = "DELETE FROM `agenda` WHERE agenda_id = '$_REQUEST[id]'";
		$stmt = $conn->prepare($query);

		var_dump($stmt);

		$stmt->execute();
		$conn = null;
		
		header('location: dashboard.php');
	}

?>