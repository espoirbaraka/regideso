<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$nom = $_POST['nom'];
        $postnom = $_POST['postnom'];
        $prenom = $_POST['prenom'];
        $tel = $_POST['tel'];
        $fonc = $_POST['fonc'];
        $resid = $_POST['resid'];
        $datenaiss = $_POST['datenaiss'];
        $username = $_POST['username'];
        $tel = $_POST['tel'];
        $password = sha1($_POST['password1']);
		$password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
       
		$conn = $pdo->open();
        $filename = $_FILES['photo']['name'];
			
            if($password1 != $password2)
            {
                if(!empty($filename)){
                    move_uploaded_file($_FILES['photo']['tmp_name'], '../images/images_db/'.$filename);	
			    }
                try{
                    $stmt = $conn->prepare("INSERT INTO t_agent(NomAgent, PostnomAgent, PrenomAgent, TelephoneAgent, DateNaissance, CodeFonction, QuartierAgent, Username, Password, Photo) VALUES(:nom, :postnom, :prenom, :tel, :date, :fonc, :quartier, :username, :password, :photo)");
                    $stmt->execute(['nom'=>$nom, 'postnom'=>$postnom, 'prenom'=>$prenom, 'tel'=>$tel, 'date'=>$datenaiss, 'fonc'=>$fonc, 'quartier'=>$resid, 'username'=>$username, 'password'=>$password, 'photo'=>$filename]);
                    $_SESSION['success'] = 'Agent ajouté';
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            }
            else{
                $_SESSION['error'] = 'Les 2 mots de passes ne sont pas les memes';
            }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../agent.php');

?>
