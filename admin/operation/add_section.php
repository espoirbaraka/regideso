<?php
	include '../includes/sessionconnected.php';

	if(isset($_POST['add'])){
		$section = $_POST['section'];
        $option = $_POST['option'];
        $today = date('Y-m-d');
		$conn = $pdo->open();
                
                try{
                    $stmt = $conn->prepare("INSERT INTO t_section(Section, Option, Created_on) VALUES(:section, :option, :created_on)");
                    $stmt->execute(['section'=>$section, 'option'=>$option, 'created_on'=>$today]);
                    $_SESSION['success'] = 'Section ajouté';
    
                }
                catch(PDOException $e){
                    $_SESSION['error'] = $e->getMessage();
                }
            

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Compléter le formulaire d\'ajout materiel';
	}

	header('location: ../section.php');

?>
