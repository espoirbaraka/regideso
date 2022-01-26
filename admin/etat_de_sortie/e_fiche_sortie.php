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
    require '../class/db.php';
    require '../class/panier.php';
    $database = new DB();
    $panier = new panier($database);
    $ids = array_keys($_SESSION['panier']);
                if(empty($ids))
                {
                    $products = array();
                }
                else {
                    $indices = implode(',',$ids);
                    if($indices != '')
                    {
                        $products = $database->query("SELECT * FROM t_produit WHERE CodeProduit IN($indices)");
                    }
                }
                $this->cell(180,10,'FICHE DE SORTIE STOCK',1,0,'C');
                $this->Ln();
   foreach($products as $product):
        $this->cell(180,10,$product->DesignationProduit,1,0,'L');
        $this->Ln();
        $this->cell(30,10,'Quantite:',1,0,'L');
        $this->cell(30,10,$_SESSION['panier'][$product->CodeProduit],1,0,'C');
        $this->cell(30,10,'Prix unitaire:',1,0,'L');
        $this->cell(30,10,$product->PVProduit,1,0,'C');
        $this->cell(30,10,'Prix total:',1,0,'L');
        $this->cell(30,10,$_SESSION['panier'][$product->CodeProduit] * $product->PVProduit,1,0,'C');
        $this->Ln();
    
 endforeach;
    $this->cell(50,10,'Nombre des produits:',1,0,'L');
    $this->cell(130,10,$panier->count().' produits',1,0,'C');
    $this->Ln();

    $this->cell(50,10,'prix total:',1,0,'L');
    $this->cell(130,10,number_format($panier->total()).' $',1,0,'C');
    $this->Ln();
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
    $pdf->montant($bdd);
    
    $pdf->viewTable($bdd);
    $pdf->Cell(0,10,'Fait a Goma le '.date('d-m-Y'),0,1);
    $pdf->Output();
?>