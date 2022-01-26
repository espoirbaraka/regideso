<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Nos agents</h1>
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
                <div class="box-header with-border" style="margin-bottom: 8px;">
                    <a href="#adduser" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nouveau</a>
                </div>
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Photo</th>
                      <th>Nom complet</th>
                      <th>Fonction</th>
                      <th>Residence</th>
                      <th>Date Naissance</th>
                      <th>Telephone</th>
                      <th>Nom d'utilisateur</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $conn = $pdo->open();

                            try{
                            $stmt = $conn->prepare("SELECT * FROM t_agent 
                                                    INNER JOIN t_fonction 
                                                    ON t_agent.CodeFonction=t_fonction.CodeFonction
                                                    INNER JOIN t_quartier
                                                    ON t_agent.QuartierAgent= t_quartier.CodeQuartier
                                                    ORDER BY NomAgent");
                            $stmt->execute();
                            foreach($stmt as $agent){
                                $image = (!empty($agent['Photo'])) ? 'images/images_db/'.$agent['Photo'] : 'images/user.png';
                                echo "
                                <tr>
                                    <td>
                                        <img src='".$image."' height='30px' width='30px'>
                                    </td>
                                    <td>".$agent['NomAgent'].' '.$agent['PostnomAgent'].' '.$agent['PrenomAgent']."</td>
                                    <td>".$agent['Fonction']."  
                                    <a href='#' class='fonction btn-sm btn-flat' data-id='".$agent['IdAgent']."'><i class='fa fa-edit'></i></a>
                                    </td>
                                    <td>".$agent['Quartier']."</td>
                                    <td>".$agent['DateNaissance']."</td>
                                    <td>".$agent['TelephoneAgent']."</td>
                                    <td>".$agent['Username']."</td>
                                    <td>
                                        <a href='#' class='btn btn-info edit btn-sm btn-flat' data-id='".$agent['IdAgent']."'><i class='fa fa-edit'></i></a>
                                        <a href='#' class='btn btn-danger delete btn-sm btn-flat' data-id='".$agent['IdAgent']."'><i class='fa fa-remove'></i></a>
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
    include("modal/agent.php");

    include("includes/script.php");
    ?>
    <script>
$(function(){

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.fonction', function(e){
    e.preventDefault();
    $('#fonction').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });


});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/agent_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.agent').val(response.IdAgent);
      $('#nom').val(response.NomAgent);
      $('#postnom').val(response.PostnomAgent);
      $('#prenom').val(response.PrenomAgent);
      $('#username').val(response.Username);
      $('#telephone').val(response.TelephoneAgent);
      $('.fullname').html(response.NomAgent+' '+response.PostnomAgent+' '+response.PrenomAgent);
    }
  });
}
</script>