<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Nos recettes</h1>
          <!-- <p>Un outil pour faciliter les ITEMS aux élèves</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="home.php">Acceuil</a></li>
        </ul>
      </div>
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Erreur!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Succès!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
                <!-- <div class="box-header with-border" style="margin-bottom: 8px;">
                    <a href="#addquartier" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nouveau</a>
                </div> -->
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Mois</th>
                      <th>Montant</th>
                      <th>Source</th>
                      <th>Date de paiement</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $conn = $pdo->open();

                            try{
                            
                                $stmt = $conn->prepare("SELECT * FROM t_paiement
                                                        INNER JOIN t_mois
                                                        ON t_paiement.CodeMois=t_mois.CodeMois
                                                        INNER JOIN t_annee
                                                        ON t_paiement.CodeAnnee=t_annee.CodeAnnee
                                                        INNER JOIN t_menage
                                                        ON t_paiement.CodeMenage=t_menage.IdMenage");
                                $stmt->execute();
                            
                            foreach($stmt as $paiement){
                                $id=$paiement['CodePaiement'];
                                echo "
                                <tr>
                                    <td>".$paiement['Mois'].' '.$paiement['Annee']."</td>
                                    <td style='color: red;'>".$paiement['Montant']." $</td>
                                    <td>".$paiement['ResponsableMenage']."</td>
                                    <td>".$paiement['DatePaiement']."</td>
                                    <td>
                                    
                                    <a href='etat_de_sortie/e_recu.php?id=$id' target='_blank' class='btn btn-primary'><i class='fa fa-print'></i> Imprimer recu</a>
                                    </td>
                                    
                                </tr>
                                ";
                            }
                            }
                            catch(PDOException $e){
                            echo $e->getMessage();
                            }

                            $pdo->close();
                        ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <?php
    include("modal/rapport.php");

    include("includes/script.php");
    ?>
    <script>
$(function(){

  $(document).on('click', '.paiement', function(e){
    e.preventDefault();
    $('#paiement').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/rapport_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#id').val(response.CodeRapport);
      $('#somme').val(response.Consommation*response.Prevision);
      $('#mois').val(response.CodeMois);
      $('#annee').val(response.CodeAnnee);
      $('#menage').val(response.IdMenage);
      $('.facture').html(response.Consommation*response.Prevision+' $');
      $('.cycle').html(response.ResponsableMenage+' pour '+response.Mois+' '+response.Annee);
    }
  });
}
</script>