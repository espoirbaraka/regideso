<?php

// $conn = $pdo->open();

// $marque = $conn->prepare("SELECT * FROM t_marque_imprimante");
// $marque->execute();
// $puissance = $conn->prepare("SELECT * FROM t_puissance_imprimante");
// $puissance->execute();
// $etat = $conn->prepare("SELECT * FROM t_etat_materiel");
// $etat->execute();
// $affectation = $conn->prepare("SELECT * FROM t_affectation");
// $affectation->execute();
// $couleur = $conn->prepare("SELECT * FROM t_couleur");
// $couleur->execute();

// $pdo->close();
?>
<!-- Add -->
<div class="modal fade" id="addsection">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="text-align: center;"><b>Ajouter une section</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/add_section.php" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="text" id="section" name="section" class="form-control" placeholder="Section">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="text" id="option" name="option" class="form-control" placeholder="Option">
                    </div>
                </div>
                
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Enregistrer</button>
              </form>
            </div>
        </div>
    </div>
</div>








     