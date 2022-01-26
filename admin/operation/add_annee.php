<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$annee = $_POST['annee'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("INSERT INTO t_annee(Annee) VALUES(:annee)");
                    $stmt->execute(['annee'=>$annee]);
                    $_SESSION['success'] = 'Annee ajouté';
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../annee.php');

?>
