<?php
	include 'conn.php';
	session_start();

	if(!isset($_SESSION['ConnectAgent']) || trim($_SESSION['ConnectAgent']) == ''){
		header('location: ./index.php');
		exit();
	}

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM t_agent 
							INNER JOIN t_fonction
							ON t_agent.CodeFonction=t_fonction.CodeFonction
							 WHERE IdAgent=:code");
	$stmt->execute(['code'=>$_SESSION['ConnectAgent']]);
	$user = $stmt->fetch();

	$pdo->close();

?>