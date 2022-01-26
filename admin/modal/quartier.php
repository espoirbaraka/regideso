<?php

$conn = $pdo->open();

$commune = $conn->prepare("SELECT * FROM t_commune");
$commune->execute();

$avenue = $conn->prepare("SELECT * FROM t_avenue");
$avenue->execute();

$verif = $conn->prepare("SELECT * FROM t_agent WHERE CodeFonction=3");
$verif->execute();

$pdo->close();
?>
 

<!-- edit -->
<div class="modal fade" id="editer" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><b>Modification</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/quartier_update.php">
                <input type="hidden" class="quartier" name="id">
                <input type="hidden" class="commune" name="commune">
                <div class="form-group">
                  <input type="text" class="form-control" name="quartier" id="quartier">
                </div>
                <div class="form-group">
                    <label for="prevision">Prevision mensuelle</label>
                    <input type="text" class="form-control" name="prevision" id="prevision">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-success btn-flat" name="update"><i class="fa fa-trash"></i> Modifier</button>
              </form>
            </div>
        </div>
    </div>
</div>



<!-- remove -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Suppression...</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/quartier_delete.php">
                <input type="hidden" class="quartier" name="id">
                <input type="hidden" class="commune" name="commune">
                <div class="text-center">
                    <p>SUPPRIMER LE QUARTIER</p>
                    <h2 class="bold quartiername"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Supprimer</button>
              </form>
            </div>
        </div>
    </div>
</div>


<!-- Add menage -->
<div class="modal fade" id="menage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"><b>Ajouter un menage dans le quartier <span class="quartiername"></span></b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/add_menage.php">
              <input type="hidden" class="quartier" name="id">
              <input type="hidden" class="" name="commune" value="<?php echo $id; ?>">
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="avenue">Avenue</label>
                            <select name="avenue" id="" class="form-control">
                                <?php
                                foreach($avenue as $row){
                                    ?>
                                    <option value="<?php echo $row['CodeAvenue']; ?>"><?php echo $row['Avenue']; ?></option>
                                <?php
                                }
                                ?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="numero" placeholder="Numero parcelle" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="longeur" placeholder="Longeur de la parcelle" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="largeur" placeholder="Largeur de la parcelle" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="nom" placeholder="Nom du responsable" required>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="telephone" placeholder="Telephone du responsable" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="mail" placeholder="Mail du responsable">
                        </div>
                        <div class="form-group">
                            <label for="avenue">Affecter un verificateur</label>
                            <select name="verif" id="" class="form-control">
                                <?php
                                foreach($verif as $row){
                                    ?>
                                    <option value="<?php echo $row['IdAgent']; ?>"><?php echo $row['NomAgent'].' '.$row['PostnomAgent'].' '.$row['PrenomAgent']; ?></option>
                                <?php
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>
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


<!-- Add -->
<div class="modal fade" id="addquartier" style="z-index: 100000;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"><b>Ajouter un quartier</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/add_quartier.php" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="quartier" placeholder="Quartier" required>
                        </div>
                        <div class="form-group">
                            <select name="commune" class="form-control" id="">
                                <?php
                                foreach($commune as $row)
                                {
                                ?>
                                <option value="<?php echo $row['CodeCommune']; ?>"><?php echo $row['Commune']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="prevision" placeholder="Prevision mensuelle" required>
                        </div>
                    </div>
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


 <!-- Add avenue -->
 <div class="modal fade" id="avenue">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="text-align: center;"><b>Ajouter une avenue</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/add_avenue.php">
              <input type="hidden" class="quartier" name="id">
              <input type="hidden" class="" name="commune" value="<?php echo $id; ?>">
                <div class="form-group">
                    <div class="col-sm-9">
                        <div class="form-group">
                            <input type="text" class="form-control" name="avenue" placeholder="Avenue" required>
                        </div>
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




















     