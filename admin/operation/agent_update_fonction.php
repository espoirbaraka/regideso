<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['update'])){
        $fonction = $_POST['fonction'];
        $id = $_POST['id'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("UPDATE t_agent SET CodeFonction=:fonction WHERE IdAgent=:id");
                    $stmt->execute(['fonction'=>$fonction, 'id'=>$id]);
                    $_SESSION['success'] = 'Fonction modifiée l\'agent';
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../agent.php');

?>
