<?php 
	include '../includes/sessionconnected.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM t_rapport
                                INNER JOIN t_menage
                                ON t_rapport.CodeMenage=t_menage.IdMenage
                                INNER JOIN t_quartier
                                ON t_menage.CodeQuartier=t_quartier.CodeQuartier
                                INNER JOIN t_mois
                                ON t_rapport.CodeMois=t_mois.CodeMois
                                INNER JOIN t_annee
                                ON t_rapport.CodeAnnee=t_annee.CodeAnnee
                                WHERE CodeRapport=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>