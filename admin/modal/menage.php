<?php

$conn = $pdo->open();

$annee = $conn->prepare("SELECT * FROM t_annee");
$annee->execute();

$mois = $conn->prepare("SELECT * FROM t_mois");
$mois->execute();


$pdo->close();
?>
 

<!-- edit -->
<div class="modal fade" id="rapport" style="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title"><b>Rediger un rapport chez <span class="bold client"></span></b></h4>
            <!-- <h3 class="bold client"></h3> -->
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="operation/add_rapport.php">
                <div class="form-group">
                  <input type="hidden" name="id" id="id">
                  <select name="annee" class="form-control" id="">
                  <?php
                  foreach($annee as $row)
                  {
                    ?>
                    <option value="<?php echo $row['CodeAnnee']; ?>"><?php echo $row['Annee']; ?></option>
                    <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group">
                    <select name="mois" class="form-control" id="">
                    <?php
                      foreach($mois as $row)
                      {
                        ?>
                        <option value="<?php echo $row['CodeMois']; ?>"><?php echo $row['Mois']; ?></option>
                        <?php
                      }
                      ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="number" name="cons" class="form-control" placeholder="Consommation du mois">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
              <button type="submit" class="btn btn-success btn-flat" name="add"><i class="fa fa-trash"></i> Rediger</button>
              </form>
            </div>
        </div>
    </div>
</div>












     