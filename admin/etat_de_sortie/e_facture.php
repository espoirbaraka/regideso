<?php
require('fpdf/fpdf.php');
require_once'../includes/sessionconnected.php';

class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    $this->Image('img/logo2.jpg',2,10,206,10);
    $this->SetFont('Arial','B',15);
    $this->Cell(30);
    $this->Ln(40);
}

// Tableau simple
function BasicTable($header, $data)
{
    // En-tête
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Données
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}







function headerTable(){
    // $this->setFont('Times','B',12);
    // $this->cell(45,7,'Produit',1,0,'C');
    // $this->cell(45,7,'Quantite',1,0,'C');
    // $this->cell(45,7,'Prix unitaire',1,0,'C');
    // $this->cell(45,7,'Prix total',1,0,'C');
    // $this->Ln();
}


function montant($conn){
    $this->setFont('Times','B',12);
    $this->cell(180,10,'NB: veuillez regler votre facture avant la fin du mois pour eviter des penalites',1,0,'C');
    $this->Ln();
    $id=$_GET['id'];
    $req=$conn->prepare("SELECT * FROM t_rapport
                        INNER JOIN t_mois
                        ON t_rapport.CodeMois=t_mois.CodeMois
                        INNER JOIN t_annee
                        ON t_rapport.CodeAnnee=t_annee.CodeAnnee
                        INNER JOIN t_agent
                        ON t_rapport.CodeVerificateur=t_agent.IdAgent
                        INNER JOIN t_menage
                        ON t_rapport.CodeMenage=t_menage.IdMenage
                        INNER JOIN t_avenue
                        ON t_menage.CodeAvenue=t_avenue.CodeAvenue
                        INNER JOIN t_quartier
                        ON t_avenue.CodeQuartier=t_quartier.CodeQuartier
                        WHERE t_rapport.CodeRapport=:code");
    $req->execute(['code'=>$id]);
    // $rows=$req->fetch(PDO::FETCH_OBJ);
    while($data = $req->fetch(PDO::FETCH_OBJ))
    {
        $this->cell(35,10,'Abonne:',1,0,'L');
        $this->cell(145,10,$data->ResponsableMenage,1,0,'L');
        $this->Ln();
        $this->cell(35,10,'Adresse:',1,0,'L');
        $this->cell(145,10,'Q: '.$data->Quartier.', Av. '.$data->Avenue.', Num: '.$data->NumParcelle,1,0,'L');
        $this->Ln();
        $this->cell(35,10,'Mois:',1,0,'L');
        $this->cell(145,10,$data->Mois.' '.$data->Annee,1,0,'L');
        $this->Ln();
        $this->cell(35,10,'Consommation:',1,0,'L');
        $this->cell(145,10,$data->Consommation.' m3',1,0,'L');
        $this->Ln();
        $this->cell(35,10,'Somme a payer:',1,0,'L');
        $this->cell(145,10,$data->Consommation*$data->Prevision.' $',1,0,'L');
        $this->Ln();

    }
    // foreach($rows as $ligne)
    // {
    //     $this->cell(90,10,$ligne->Consommation,1,0,'L');
    //     $this->cell(90,10,$ligne->CodeMois,1,0,'L');
    //     $this->Ln();
    // }
}


function viewTable($conn){
    $this->setFont('Times','B',12);
}







}

    // Instanciation de la classe dérivée
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',14);
    $pdf->AddPage();
    // $pdf->headerTable();
    $pdf->montant($conn);
    
    $pdf->viewTable($conn);
    $pdf->Cell(0,10,'Fait a Goma le '.date('d-m-Y'),0,1);
    $pdf->Output();
?>