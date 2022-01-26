<?php

$conn = $pdo->open();

$commune = $conn->prepare("SELECT * FROM t_commune");
$commune->execute();


$pdo->close();
?>
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
                
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Enregistrer</button>
              </form>
            </div>
        </div>
    </div>
</div>