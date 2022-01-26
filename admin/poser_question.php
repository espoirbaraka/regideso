<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");

$conn = $pdo->open();

$section = $conn->prepare("SELECT * FROM t_section WHERE IdSection=?");
$section->execute(array($_GET['sec']));
$row = $section->fetch();

$cours = $conn->prepare("SELECT * FROM t_cours");
$cours->execute();

$annee = $conn->prepare("SELECT * FROM t_annee");
$annee->execute();

$pdo->close();
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Poser une question:: <?php echo $row['Section'].' '.$row['Option']; ?></h1>
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
      <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Pose la question</h3>
            <div class="tile-body">
              <form class="row" method="POST" action="operation/poser_question.php">
                <input type="hidden" name="section" value="<?php echo $_GET['sec']; ?>">
                <div class="form-group col-md-5">
                  <label class="control-label">Cours</label>
                  <select class="form-control" name="cours" id="cours">
                  <?php
                  foreach($cours as $row)
                  {
                      ?>
                        <option value="<?php echo $row['CodeCours']; ?>"><?php echo $row['Cours']; ?></option>
                      <?php
                  }
                  ?>
                  </select>
                </div>
                <div class="form-group col-md-5">
                  <label class="control-label">Edition</label>
                  <select class="form-control" name="edition" id="edition">
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
                <div class="form-group col-md-10">
                  <label class="control-label">Question</label>
                  <textarea class="form-control" name="question" id="question" cols="30" rows="7"></textarea>
                </div>
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit" name="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Poser</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </main>
    <?php
    include("modal/question.php");

    include("includes/script.php");
    ?>