<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['update'])){
		$quartier = $_POST['quartier'];
        $commune = $_POST['commune'];
        $prevision = $_POST['prevision'];
        $id = $_POST['id'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("UPDATE t_quartier SET Quartier=:quartier, Prevision=:prevision WHERE CodeQuartier=:code");
                    $stmt->execute(['quartier'=>$quartier, 'prevision'=>$prevision, 'code'=>$id]);
                    $_SESSION['success'] = 'Quartier Modifié';
    
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
