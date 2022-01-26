<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['update'])){
		$nom = $_POST['nom'];
        $postnom = $_POST['postnom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];
        $telephone = $_POST['telephone'];
        $id = $_POST['id'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("UPDATE t_agent SET NomAgent=:nom, PostnomAgent=:postnom, PrenomAgent=:prenom, Username=:username, TelephoneAgent=:telephone WHERE IdAgent=:id");
                    $stmt->execute(['nom'=>$nom, 'postnom'=>$postnom, 'prenom'=>$prenom, 'username'=>$username, 'telephone'=>$telephone, 'id'=>$id]);
                    $_SESSION['success'] = 'Agent Modifié';
    
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
