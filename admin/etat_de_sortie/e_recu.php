<?php
require('fpdf/fpdf.php');
require_once'../includes/sessionconnected.php';

class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    $this->Image('img/logo3.jpg',2,10,206,40);
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
    $this->cell(180,10,'Merci pour la fidelite cher client',1,0,'C');
    $this->Ln();
    $id=$_GET['id'];
    $req=$conn->prepare("SELECT * FROM t_paiement
                        INNER JOIN t_mois
                        ON t_paiement.CodeMois=t_mois.CodeMois
                        INNER JOIN t_annee
                        ON t_paiement.CodeAnnee=t_annee.CodeAnnee
                        INNER JOIN t_menage
                        ON t_paiement.CodeMenage=t_menage.IdMenage
                        INNER JOIN t_avenue
                        ON t_menage.CodeAvenue=t_avenue.CodeAvenue
                        INNER JOIN t_quartier
                        ON t_avenue.CodeQuartier=t_quartier.CodeQuartier
                        WHERE t_paiement.CodePaiement=:code");
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
        $this->cell(35,10,'Date paiement:',1,0,'L');
        $this->cell(145,10,$data->DatePaiement,1,0,'L');
        $this->Ln();
        $this->cell(35,10,'Montant:',1,0,'L');
        $this->cell(145,10,$data->Montant.' $',1,0,'L');
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