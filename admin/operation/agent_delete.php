<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['delete'])){
        $id = $_POST['id'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("DELETE FROM t_agent WHERE IdAgent=:id");
                    $stmt->execute(['id'=>$id]);
                    $_SESSION['success'] = 'Agent Supprimé';
    
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
