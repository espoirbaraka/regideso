<?php
	include './includes/conn.php';
	session_start();


	if(isset($_SESSION['ConnectAgent'])){
		if(isset($_SESSION['privilege']))
		{
			header('location: home.php');
		}
	}
	// elseif(isset($_SESSION['ConnectComptable'])){
	// 	header('location: home.php?id='.$_SESSION['ConnectComptable']);
	// }
	// elseif(isset($_SESSION['ConnectVerificateur'])){
	// 	header('location: home.php?id='.$_SESSION['ConnectVerificateur']);
	// }
	// elseif(isset($_SESSION['ConnectEleve']))
	// {
	// 	header('location: ../index.php');
	// }

?>