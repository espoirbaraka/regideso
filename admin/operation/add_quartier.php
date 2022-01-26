<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$quartier = $_POST['quartier'];
        $commune = $_POST['commune'];
        $prevision = $_POST['prevision'];
       
		$conn = $pdo->open();
			
                try{
                    $stmt = $conn->prepare("INSERT INTO t_quartier(Quartier, CodeCommune, Prevision) VALUES(:quartier, :commune, :prevision)");
                    $stmt->execute(['quartier'=>$quartier, 'commune'=>$commune, 'prevision'=>$prevision]);
                    $_SESSION['success'] = 'Quartier ajouté';
    
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
