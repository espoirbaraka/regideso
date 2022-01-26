<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $commune = $_POST['commune'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("DELETE FROM t_quartier WHERE CodeQuartier=:code");
                    $stmt->execute(['code'=>$id]);
                    $_SESSION['success'] = 'Quartier Supprimé';
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../quartier.php?id='.$commune);

?>
