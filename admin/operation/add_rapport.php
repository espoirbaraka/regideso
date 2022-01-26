<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$annee = $_POST['annee'];
        $mois = $_POST['mois'];
        $menage = $_POST['id'];
        $cons = $_POST['cons'];
        $verif = $_SESSION['ConnectAgent'];
        $today = date('Y-m-d');
       
		$conn = $pdo->open();
			
                try{
                    $stmt = $conn->prepare("SELECT * FROM t_rapport WHERE CodeAnnee=:annee AND CodeMois=:mois AND CodeMenage=:menage");
                    $stmt->execute(['annee'=>$annee, 'mois'=>$mois, 'menage'=>$menage]);
                    $countresult=$stmt->rowCount();
                    if($countresult==0)
                    {
                        $stmt2 = $conn->prepare("INSERT INTO t_rapport(CodeMois, CodeAnnee, CodeMenage, CodeVerificateur, Consommation, DateRapport, State) VALUES(:mois, :annee, :menage, :verif, :consommation, :date, :status)");
                        $stmt2->execute(['mois'=>$mois, 'annee'=>$annee, 'menage'=>$menage, 'verif'=>$verif, 'consommation'=>$cons, 'date'=>$today, 'status'=>0]);
                        $_SESSION['success'] = 'Rapport ajouté';
                    }
                    else{
                        $_SESSION['error'] = "Rapport existant pour ce mois a ce menage";
                    }
                    
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../rapport.php');

?>
