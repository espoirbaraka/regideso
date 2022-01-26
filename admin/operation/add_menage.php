<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$quartier = $_POST['id'];
        $commune = $_POST['commune'];
        $avenue = $_POST['avenue'];
        $numero = $_POST['numero'];
        $longuer = $_POST['longeur'];
        $largeur = $_POST['largeur'];
        $verif = $_POST['verif'];
        $tel = $_POST['telephone'];
        $mail = $_POST['mail'];
        $nom = $_POST['nom'];
       
		$conn = $pdo->open();
			
                try{
                    $stmt = $conn->prepare("INSERT INTO t_menage(CodeAvenue, CodeQuartier, NumParcelle, LongeurParcelle, LargeurParcelle, CodeVerificateur, ResponsableMenage, TelephoneResponsable, EmailResponsable, Status) VALUES(:avenue, :quartier, :num, :longeur, :largeur, :verif, :responsable, :telephone, :email, :status)");
                    $stmt->execute(['avenue'=>$avenue, 'quartier'=>$quartier, 'num'=>$numero, 'longeur'=>$longuer, 'largeur'=>$largeur, 'verif'=>$verif, 'responsable'=>$nom, 'telephone'=>$tel, 'email'=>$mail, 'status'=>0]);
                    $_SESSION['success'] = 'Menage ajouté';
    
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
