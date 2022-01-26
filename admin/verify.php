<?php
	include 'includes/sessionoutconnected.php';
	$conn = $pdo->open();

	if(isset($_POST['connect'])){
		$username = $_POST['username'];
		$password = htmlspecialchars(sha1($_POST['password']));
		try{
			$stmt = $conn->prepare("SELECT * FROM t_agent WHERE Username = ? AND Password=?");
            $stmt->execute(array($username,$password));
			$nbre = $stmt->rowCount();
			
			if($nbre == 1){
				$row = $stmt->fetch();


				$_SESSION['ConnectAgent'] = $row['IdAgent'];
				$_SESSION['privilege'] = $row['CodeFonction'];
				// if($row['CodeFonction'] == 1){
							// $_SESSION['ConnectSuperadmin'] = $row['IdAgent'];
							// $_SESSION['fonction'] = $row['CodeFonction'];
				// }
				// elseif($row['CodeFonction'] == 2){
				// 	$_SESSION['ConnectComptable'] = $row['IdAgent'];
				// }
				// elseif($row['CodeFonction'] == 3){
				// 	$_SESSION['ConnectVerificateur'] = $row['IdAgent'];
				// }
			}
			else{
				$_SESSION['error'] = 'Utilisateur inexistant';
			}
		}
		catch(PDOException $e){
			echo "Erreur de connexion: " . $e->getMessage();
		}
	


	}
	else{
		$_SESSION['error'] = 'Entrez vos identifiants de connexion d\'abord';
	}

	$pdo->close();
	header('location: index.php');

?>
