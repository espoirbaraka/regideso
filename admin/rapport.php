<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Rapport de consommation</h1>
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
                      <th>Abonne</th>
                      <th>Mois</th>
                      <th>Consommation</th>
                      <th>Prevision</th>
                      <th>Facture</th>
                      <th>Verificateur</th>
                      <th>Date de redaction</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $conn = $pdo->open();

                            try{
                            if($_SESSION['privilege']==1)
                            {
                                $stmt = $conn->prepare("SELECT * FROM t_rapport
                                                        INNER JOIN t_mois
                                                        ON t_rapport.CodeMois=t_mois.CodeMois
                                                        INNER JOIN t_annee
                                                        ON t_rapport.CodeAnnee=t_annee.CodeAnnee
                                                        INNER JOIN t_agent
                                                        ON t_rapport.CodeVerificateur=t_agent.IdAgent
                                                        INNER JOIN t_menage
                                                        ON t_rapport.CodeMenage=t_menage.IdMenage
                                                        INNER JOIN t_quartier
                                                        ON t_menage.CodeQuartier=t_quartier.CodeQuartier
                                                        ORDER BY t_mois.CodeMois AND t_annee.CodeAnnee DESC");
                                $stmt->execute();
                            }
                            elseif($_SESSION['privilege']==2)
                            {
                                $stmt = $conn->prepare("SELECT * FROM t_rapport
                                                        INNER JOIN t_mois
                                                        ON t_rapport.CodeMois=t_mois.CodeMois
                                                        INNER JOIN t_annee
                                                        ON t_rapport.CodeAnnee=t_annee.CodeAnnee
                                                        INNER JOIN t_agent
                                                        ON t_rapport.CodeVerificateur=t_agent.IdAgent
                                                        INNER JOIN t_menage
                                                        ON t_rapport.CodeMenage=t_menage.IdMenage
                                                        INNER JOIN t_quartier
                                                        ON t_menage.CodeQuartier=t_quartier.CodeQuartier
                                                        ORDER BY t_mois.CodeMois AND t_annee.CodeAnnee DESC");
                                $stmt->execute();
                            }
                            else{
                                $id=$_SESSION['ConnectAgent'];
                                $stmt = $conn->prepare("SELECT * FROM t_rapport
                                                        INNER JOIN t_mois
                                                        ON t_rapport.CodeMois=t_mois.CodeMois
                                                        INNER JOIN t_annee
                                                        ON t_rapport.CodeAnnee=t_annee.CodeAnnee
                                                        INNER JOIN t_agent
                                                        ON t_rapport.CodeVerificateur=t_agent.IdAgent
                                                        INNER JOIN t_menage
                                                        ON t_rapport.CodeMenage=t_menage.IdMenage
                                                        INNER JOIN t_quartier
                                                        ON t_menage.CodeQuartier=t_quartier.CodeQuartier
                                                        WHERE t_rapport.CodeVerificateur=$id
                                                        ORDER BY t_mois.CodeMois AND t_annee.CodeAnnee DESC");
                                $stmt->execute();
                            }
                            
                            foreach($stmt as $rapport){
                              $status = $rapport['State'];
                              if($_SESSION['privilege']==3)
                              {
                                $facture = $rapport['Consommation'] * $rapport['Prevision'];
                                $id=$rapport['CodeRapport'];
                                echo "
                                <tr>
                                    <td>".$rapport['ResponsableMenage']."</td>
                                    <td>".$rapport['Mois'].' '.$rapport['Annee']."</td>
                                    <td>".$rapport['Consommation']." m<sup>3</sup></td>
                                    <td>".$rapport['Prevision']." $</td>
                                    <td style='color: red;'>".$facture." $</td>
                                    <td>".$rapport['NomAgent']."</td>
                                    <td>".$rapport['DateRapport']."</td>
                                    <td>
                                    
                                    <a href='etat_de_sortie/e_facture.php?id=$id' target='_blank' class='btn btn-primary'><i class='fa fa-print'></i> Imprimer facture</a>
                                    </td>
                                    
                                </tr>
                                ";
                              }
                              elseif($_SESSION['privilege']==1)
                              {
                                $facture = $rapport['Consommation'] * $rapport['Prevision'];
                                
                                echo "
                                <tr>
                                    <td>".$rapport['ResponsableMenage']."</td>
                                    <td>".$rapport['Mois'].' '.$rapport['Annee']."</td>
                                    <td>".$rapport['Consommation']." m<sup>3</sup></td>
                                    <td>".$rapport['Prevision']." $</td>
                                    <td style='color: red;'>".$facture." $</td>
                                    <td>".$rapport['NomAgent']."</td>
                                    <td>".$rapport['DateRapport']."</td>
                                    <td>
                                    <a href='#' class='btn btn-primary rapport btn-sm btn-flat' data-id='".$rapport['CodeRapport']."'><i class='fa fa-edit'></i> Voir</a>
                                    </td>
                                    
                                </tr>
                                ";
                              }
                              elseif($_SESSION['privilege']==2)
                              {
                                $facture = $rapport['Consommation'] * $rapport['Prevision'];
                                
                                if($status==0){
                                  echo "
                                  <tr>
                                      <td>".$rapport['ResponsableMenage']."</td>
                                      <td>".$rapport['Mois'].' '.$rapport['Annee']."</td>
                                      <td>".$rapport['Consommation']." m<sup>3</sup></td>
                                      <td>".$rapport['Prevision']." $</td>
                                      <td style='color: red;'>".$facture." $</td>
                                      <td>".$rapport['NomAgent']."</td>
                                      <td>".$rapport['DateRapport']."</td>
                                      <td>
                                      <a href='#' class='btn btn-success paiement btn-sm btn-flat' data-id='".$rapport['CodeRapport']."'><i class='fa fa-edit'></i> Paiement</a>
                                      </td>
                                      
                                  </tr>
                                  ";
                                }
                                elseif($status==1){
                                  echo "
                                <tr>
                                    <td>".$rapport['ResponsableMenage']."</td>
                                    <td>".$rapport['Mois'].' '.$rapport['Annee']."</td>
                                    <td>".$rapport['Consommation']." m<sup>3</sup></td>
                                    <td>".$rapport['Prevision']." $</td>
                                    <td style='color: red;'>".$facture." $</td>
                                    <td>".$rapport['NomAgent']."</td>
                                    <td>".$rapport['DateRapport']."</td>
                                    <td>
                                    <button class='btn btn-danger btn-sm desactivate btn-flat' data-id='' disabled> Déjà reglé</button>
                                    </td>
                                    
                                </tr>
                                ";
                                }
                                
                              }
                                
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