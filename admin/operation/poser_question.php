<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$cours = $_POST['cours'];
        $edition = $_POST['edition'];
        $question = $_POST['question'];
        $today = date('Y-m-d');
        $section = $_POST['section'];
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("INSERT INTO t_question(CodeAnnee,CodeCours,CodeSection, Question, DateQuestion) VALUES(:annee, :cours, :section, :question, :date)");
                    $stmt->execute(['annee'=>$edition, 'cours'=>$cours, 'section'=>$section, 'question'=>$question, 'date'=>$today]);
                    $_SESSION['success'] = 'Questionnaire ajouté';

                        
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header("location: ../poser_question.php?sec=$section");

?>
