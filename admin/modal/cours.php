<?php

$conn = $pdo->open();

$domaine = $conn->prepare("SELECT * FROM t_domaine");
$domaine->execute();

$pdo->close();
?>
<!-- Add -->
<div class="modal fade" id="addcours">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" style="text-align: center;"><b>Ajouter un cours</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/add_cours.php" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="col-sm-9">
                      <input type="text" id="cours" name="cours" class="form-control" placeholder="cours">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9">
                      <select name="domaine" id="domaine" class="form-control">
                          <?php
                          foreach($domaine as $row)
                          {
                              ?>
                                <option value="<?php echo $row['IdDomaine']; ?>"><?php echo $row['Domaine']; ?></option>
                              <?php
                          }
                          ?>
                      </select>
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








     