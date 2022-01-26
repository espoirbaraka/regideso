<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$avenue = $_POST['avenue'];
        $id = $_POST['id'];
        $commune = $_POST['commune'];
       
		$conn = $pdo->open();
			
                try{
                    $stmt = $conn->prepare("INSERT INTO t_avenue(Avenue, CodeQuartier) VALUES(:avenue, :code)");
                    $stmt->execute(['avenue'=>$avenue, 'code'=>$id]);
                    $_SESSION['success'] = 'Avenue ajouté';
    
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
