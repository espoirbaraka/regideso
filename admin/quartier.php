<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");

$conn = $pdo->open();

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM t_quartier 
INNER JOIN t_commune 
ON t_quartier.CodeCommune=t_commune.CodeCommune
WHERE t_quartier.CodeCommune=$id");
$stmt->execute();

$stmt2=$conn->prepare("SELECT * FROM t_commune WHERE CodeCommune=$id");
$stmt2->execute();
$nomcommune=$stmt2->fetch();


$pdo->close();
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Quartiers de la commune de <?php echo $nomcommune['Commune']; ?></h1>
          <!-- <p>Un outil pour faciliter les ITEMS aux élèves</p> -->
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="Commune.php">Commune</a></li>
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
                    
                </div>
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>Quartier</th>
                      <th>Commune</th>
                      <th>Prevision mensuelle</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $conn = $pdo->open();

                            try{
                            foreach($stmt as $quartier){
                                echo "
                                <tr>
                                    <td>".$quartier['Quartier']."</td>
                                    <td>".$quartier['Commune']."</td>
                                    <td>".$quartier['Prevision']." $ par m <sup>3</sup></td>
                                    <td>
                                        <a href='#' class='btn btn-success menage btn-sm btn-flat' data-id='".$quartier['CodeQuartier']."'><i class='fa fa-home'></i> Ajouter menage</a>
                                        <a href='#' class='btn btn-primary avenue1 btn-sm btn-flat' data-id='".$quartier['CodeQuartier']."'><i class='fa fa-plus'></i> Avenue</a>
                                        <a href='#' class='btn btn-info edit btn-sm btn-flat' data-id='".$quartier['CodeQuartier']."'><i class='fa fa-edit'></i></a>
                                        <a href='#' class='btn btn-danger delete btn-sm btn-flat' data-id='".$quartier['CodeQuartier']."'><i class='fa fa-remove'></i></a>
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
    include("modal/quartier.php");

    include("includes/script.php");
    ?>
    <script>
$(function(){
  $(document).on('click', '.avenue1', function(e){
    e.preventDefault();
    $('#avenue').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.menage', function(e){
    e.preventDefault();
    $('#menage').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#editer').modal('show');
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
      $('.commune').val(response.CodeCommune);
      $('#prevision').val(response.Prevision);
      $('.quartiername').html(response.Quartier+' ?');
    }
  });
}
</script>
