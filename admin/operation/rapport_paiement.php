<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['effectuer'])){
		$somme = $_POST['somme'];
        $id = $_POST['id'];
        $mois = $_POST['mois'];
        $annee = $_POST['annee'];
        $menage = $_POST['menage'];
        $montant = $_POST['montant'];
        $today = date('Y-m-d');
       
		$conn = $pdo->open();
			if($montant>=$somme)
            {
                try{
                    $stmt = $conn->prepare("INSERT INTO t_paiement(CodeMenage, CodeRapport, CodeMois, CodeAnnee, Montant, DatePaiement) VALUES(:menage, :rapport, :mois, :annee, :montant, :date)");
                    $stmt->execute(['menage'=>$menage, 'rapport'=>$id, 'mois'=>$mois, 'annee'=>$annee, 'montant'=>$montant, 'date'=>$today]);
                    $stmt2=$conn->prepare("UPDATE t_rapport SET State=:status WHERE CodeRapport=:rapport");
                    $stmt2->execute(['status'=>1, 'rapport'=>$id]);
                    $_SESSION['success'] = 'Payement effectuer';
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            else{
                $_SESSION['error'] = "Vous devez payer la somme totale que vous nous devez";
            }
                
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../rapport.php');

?>
