<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Communes de la ville</h1>
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
               
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Commune</th>
                      <th>Nombre des quartiers</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $conn = $pdo->open();

                            try{
                            $stmt = $conn->prepare("SELECT t_commune.CodeCommune, Commune, COUNT(CodeQuartier) as nbrequartier FROM t_commune
                                                    INNER JOIN t_quartier
                                                    ON t_quartier.CodeCommune=t_commune.CodeCommune
                                                    GROUP BY t_commune.CodeCommune");
                            $stmt->execute();
                            foreach($stmt as $commune){
                                echo "
                                <tr>
                                    <td>".$commune['Commune']."</td>
                                    <td>".$commune['nbrequartier']." Quartiers</td>
                                    <td>
                                      <a href='quartier.php?id=".$commune['CodeCommune']."' class='btn btn-primary add btn-sm btn-flat'><i class='fa fa-see'></i> Voir les quartiers</a>
                                      <a href='#addquartier' data-toggle='modal' class='btn btn-primary btn-sm btn-flat'><i class='fa fa-plus'></i> Ajouter quartier</a>
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
    include("modal/commune.php");

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

  // $(document).on('click', '.photo', function(e){
  //   e.preventDefault();
  //   var id = $(this).data('id');
  //   getRow(id);
  // });


});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'operation/quartier_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.quartier').val(response.CodeQuartier);
      $('#quartier').val(response.Quartier);
      $('#prevision').val(response.Prevision);
      $('.quartiername').html(response.Quartier+' ?');
    }
  });
}
</script>