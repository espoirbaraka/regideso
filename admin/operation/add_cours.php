<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$cours = $_POST['cours'];
        $domaine = $_POST['domaine'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("INSERT INTO t_cours(Cours,CodeDomaine) VALUES(:cours, :domaine)");
                    $stmt->execute(['cours'=>$cours, 'domaine'=>$domaine]);
                    $_SESSION['success'] = 'Un cours a été ajouté';
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../cours.php');

?>
