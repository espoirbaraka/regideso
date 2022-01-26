<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Utilisateurs</h1>
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
                      <th>Username</th>
                      <th>Nom complet</th>
                      <th>Matricule</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php
                            $conn = $pdo->open();

                            try{
                            $stmt = $conn->prepare("SELECT * FROM t_user");
                            $stmt->execute();
                            foreach($stmt as $user){
                                $image = (!empty($user['Photo'])) ? 'images/images_db/'.$user['Photo'] : 'images/user.png';
                                echo "
                                <tr>
                                    <td>
                                        <img src='".$image."' height='30px' width='30px'>
                                    </td>
                                    <td>".$user['Username']."</td>
                                    <td>".$user['NomUser'].'  '.$user['PostnomUser']."</td>
                                    <td>".$user['Matricule']."</td>
                                    <td>".$user['Email']."</td>
                                    <td>
                                        <a href='#' class='btn btn-info btn-sm btn-flat'><i class='fa fa-edit'></i> Edit</a>
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
    include("modal/user.php");

    include("includes/script.php");
    ?>