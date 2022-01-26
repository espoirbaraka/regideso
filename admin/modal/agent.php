<?php

$conn = $pdo->open();

$fonction = $conn->prepare("SELECT * FROM t_fonction");
$fonction->execute();
$fonction2 = $conn->prepare("SELECT * FROM t_fonction");
$fonction2->execute();
$quartier = $conn->prepare("SELECT * FROM t_quartier");
$quartier->execute();
// $etat = $conn->prepare("SELECT * FROM t_etat_materiel");
// $etat->execute();
// $affectation = $conn->prepare("SELECT * FROM t_affectation");
// $affectation->execute();
// $couleur = $conn->prepare("SELECT * FROM t_couleur");
// $couleur->execute();

$pdo->close();
?>
<!-- edit -->
<div class="modal fade" id="edit" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b>Modification</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/agent_update.php">
                <input type="hidden" class="agent" name="id">
                <div class="form-group">
                  <input type="text" class="form-control" name="nom" id="nom">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="postnom" id="postnom">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="prenom" id="prenom">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" name="telephone" id="telephone">
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
              <form class="form-horizontal" method="POST" action="operation/agent_delete.php">
                <input type="hidden" class="agent" name="id">
                <div class="text-center">
                    <p>SUPPRIMER L'AGENT</p>
                    <h2 class="bold fullname"></h2>
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

<!-- fonction -->
<div class="modal fade" id="fonction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Modifier la fonction</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/agent_update_fonction.php">
                <input type="hidden" class="agent" name="id">
                    <div class="form-group">
                      <select name="fonction" class="form-control" id="">
                        <?php
                        foreach($fonction2 as $row2)
                        {
                          ?>
                          <option value="<?php echo $row2['CodeFonction']; ?>"><?php echo $row2['Fonction']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-danger btn-flat" name="update"><i class="fa fa-trash"></i> Modifier</button>
              </form>
            </div>
        </div>
    </div>
</div>






<!-- Add -->
<div class="modal fade" id="adduser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="text-align: center;"><b>Ajouter utilisateur</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/add_agent.php" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="text" id="postnom" name="postnom" class="form-control" placeholder="Postnom">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prenom">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <select class="form-control" name="fonc" id="">
                        <?php
                        foreach($fonction as $row)
                        {
                          ?>
                           <option value="<?php echo $row['CodeFonction']; ?>"><?php echo $row['Fonction']; ?></option>
                          <?php
                        }
                        ?>
                         
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <select class="form-control" name="resid" id="" required>
                      <?php
                        foreach($quartier as $row)
                        {
                          ?>
                           <option value="<?php echo $row['CodeQuartier']; ?>"><?php echo $row['Quartier']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="date" id="datenaiss" name="datenaiss" class="form-control" placeholder="Date de Naissance" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="number" id="tel" name="tel" class="form-control" placeholder="Telephone">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="password" id="password1" name="password1" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="password" id="password2" name="password1" class="form-control" placeholder="Re-insere le password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" class="form-control">
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












     