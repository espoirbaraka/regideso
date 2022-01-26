<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Menages</h1>
          <!-- <p>Un outil pour faciliter les ITEMS aux élèves</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="hpme.php">Acceuil</a></li>
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
                      <th>Adresse</th>
                      <th>Responsable</th>
                      <th>Superficie</th>
                      <th>Verificateur</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $conn = $pdo->open();

                            try{
                            if($_SESSION['privilege']==1)
                            {
                                $stmt = $conn->prepare("SELECT * FROM t_menage
                                                    INNER JOIN t_agent
                                                    ON t_menage.CodeVerificateur=t_agent.IdAgent
                                                    INNER JOIN t_quartier
                                                    ON t_menage.CodeQuartier=t_quartier.CodeQuartier
                                                    INNER JOIN t_avenue
                                                    ON t_menage.CodeAvenue=t_avenue.CodeAvenue");
                                $stmt->execute();
                            }
                            else{
                                $id=$_SESSION['ConnectAgent'];
                                $stmt = $conn->prepare("SELECT * FROM t_menage
                                                    INNER JOIN t_agent
                                                    ON t_menage.CodeVerificateur=t_agent.IdAgent
                                                    INNER JOIN t_quartier
                                                    ON t_menage.CodeQuartier=t_quartier.CodeQuartier
                                                    INNER JOIN t_avenue
                                                    ON t_menage.CodeAvenue=t_avenue.CodeAvenue
                                                    WHERE t_menage.CodeVerificateur=$id");
                                $stmt->execute();
                            }
                            
                            foreach($stmt as $menage){
                                $status = ($menage['Status']) ? '<span class="label label-success">active</span>' : '<span class="label label-danger">inactif</span>';
                                $active = (!$menage['Status']) ? '<span class="pull-right"><a href="#activate" class="status" data-toggle="modal" data-id="'.$menage['IdMenage'].'"><i class="fa fa-check-square-o"></i></a></span>' : '';
                                echo "
                                <tr>
                                    <td>Q. ".$menage['Quartier'].', Av. '.$menage['Avenue'].', Num: '.$menage['NumParcelle']."</td>
                                    
                                    <td>".$menage['ResponsableMenage']."</td>
                                    <td>".$menage['LongeurParcelle'].' sur '.$menage['LargeurParcelle']." m<sup>2</sup></td>
                                    <td>".$menage['NomAgent']."</td>
                                    <td>
                                    
                                    <a href='#' class='btn btn-primary rapport btn-sm btn-flat' data-id='".$menage['IdMenage']."'><i class='fa fa-edit'></i> Rapport</a>
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
    include("modal/menage.php");

    include("includes/script.php");
    ?>
    <script>
$(function(){

  $(document).on('click', '.rapport', function(e){
    e.preventDefault();
    $('#rapport').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/menage_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#id').val(response.IdMenage);
      $('.client').html(response.ResponsableMenage+' ?');
    }
  });
}
</script>