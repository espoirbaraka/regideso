<?php
require('fpdf/fpdf.php');
require_once'../include/bd.php';

class PDF extends FPDF
{
// En-tête
function Header()
{
    // Logo
    $this->Image('img/hopital.jpg',2,10,206,40);
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(30);
    // Titre
    // $this->Cell(180,10,'Titre',1,0,'C');
    // Saut de ligne
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
    $this->setFont('Times','B',12);
    $this->cell(45,7,'Produit',1,0,'C');
    $this->cell(45,7,'Quantite',1,0,'C');
    $this->cell(45,7,'Prix unitaire',1,0,'C');
    $this->cell(45,7,'Prix total',1,0,'C');
    $this->Ln();
}


function montant($bdd){
    $this->setFont('Times','B',12);
    $id=$_GET['id'];
    $req=$bdd->prepare("SELECT DesignationProduit as produit, NomFournisseur as fournisseur,
                    CodeApprovisionnement,DateApprovisionnement,DateFabrication,DateExpiration,
                    PrixUnitaireAchat,PrixTotalAchat,QuantiteApprovisionnement from t_approvisionnement
                    inner join t_produit on t_approvisionnement.CodeProduit=t_produit.CodeProduit
                    inner join t_fournisseur on  t_approvisionnement.CodeFournisseur=t_fournisseur.CodeFournisseur
                    WHERE CodeApprovisionnement=?");
	$params=array($id);
	$req->execute($params);
    while($data = $req->fetch(PDO::FETCH_OBJ))
    {
    $now   = time();
    $date2 = strtotime($data->DateExpiration);
    $diff= abs($date2-$now)/86400;
        $this->cell(180,10,'FICHE D\'ENTRE STOCK',1,0,'C');
        $this->Ln();

        $this->cell(35,10,'Date achat:',1,0,'L');
        $this->cell(145,10,$data->DateApprovisionnement,1,0,'L');
        $this->Ln();

       
        $this->cell(35,10,'Produit:',1,0,'L');
        $this->cell(145,10,$data->produit,1,0,'L');
        $this->Ln();

        $this->cell(35,10,'Date fabrication:',1,0,'L');
        $this->cell(145,10,$data->DateFabrication,1,0,'L');
        $this->Ln();

        $this->cell(35,10,'Date expiration:',1,0,'L');
        $this->cell(145,10,$data->DateExpiration,1,0,'L');
        $this->Ln();

        $this->cell(35,10,'Peremption:',1,0,'L');
        $this->cell(145,10,floor($diff).' Jours restants pour que le produit '.$data->produit.' soit expire',1,0,'L');
        $this->Ln();

        $this->cell(35,10,'Quantite achete:',1,0,'L');
        $this->cell(145,10,$data->QuantiteApprovisionnement.' Produits',1,0,'L');
        $this->Ln();

        $this->cell(35,10,'Prix unitaire:',1,0,'L');
        $this->cell(145,10,$data->PrixUnitaireAchat.' $',1,0,'L');
        $this->Ln();

        $this->cell(35,10,'Prix total:',1,0,'L');
        $this->cell(145,10,$data->PrixTotalAchat.' $',1,0,'L');
        $this->Ln();

        $this->cell(35,10,'Fournisseur:',1,0,'L');
        $this->cell(145,10,$data->fournisseur,1,0,'L');
        $this->Ln();


        // $this->cell(25,10,'Quantite:',1,0,'C');
        // $this->cell(20,10,$data->QuantiteApprovisionnement,1,0,'C');
        // $this->cell(25,10,'Prix unitaire:',1,0,'C');
        // $this->cell(20,10,$data->PrixUnitaireAchat,1,0,'C');
        // $this->cell(25,10,'Prix total:',1,0,'C');
        // $this->cell(20,10,$data->PrixTotalAchat,1,0,'C');
        // $this->cell(25,10,'Fournisseur:',1,0,'C');
        // $this->cell(20,10,$data->fournisseur,1,0,'C');
        // $this->Ln();
    }
}


function viewTable($bdd){
    $this->setFont('Times','B',12);
}







}

    // Instanciation de la classe dérivée
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',14);
    $pdf->AddPage();
    // $pdf->headerTable();
    $pdf->montant($bdd);
    
    $pdf->viewTable($bdd);
    $pdf->Cell(0,10,'Fait a Goma le '.date('d-m-Y'),0,1);
    $pdf->Output();
?>