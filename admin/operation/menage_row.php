<?php 
	include '../includes/sessionconnected.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM t_menage
                                INNER JOIN t_agent
                                ON t_menage.CodeVerificateur=t_agent.IdAgent
                                INNER JOIN t_quartier
                                ON t_menage.CodeQuartier=t_quartier.CodeQuartier
                                INNER JOIN t_avenue
                                ON t_menage.CodeAvenue=t_avenue.CodeAvenue
                                WHERE IdMenage=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		
		$pdo->close();

		echo json_encode($row);
	}
?>