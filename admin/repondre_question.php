<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");

$conn = $pdo->open();

$question = $conn->prepare("SELECT * FROM t_question WHERE CodeQuestion=?");
$question->execute(array($_GET['id']));
$row = $question->fetch();


$pdo->close();
?>

<main class="app-content">
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <p>QUESTION: <?php echo $row['Question']; ?></p></div>
          </div>
        </div>
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
            
            <div class="tile-body">
              <form class="row" method="POST" action="operation/repondre_question.php?id=<?php echo $_GET['id']; ?>">
                <input type="hidden" name="question" value="<?php echo $_GET['id']; ?>">

                <?php
                for($i=1; $i<=5; $i++)
                {
                  ?>
                  <div class="form-group col-md-4">
                        <label class="control-label">Assertion <?php echo $i; ?></label>
                        <textarea class="form-control" name="question<?php echo $i; ?>" id="question<?php echo $i; ?>" cols="30" rows="2"></textarea>
                  </div>
                  <?php
                }
                ?>
                  <div class="form-group col-md-4">
                        <label class="control-label" style="color: red; font-weight: bold; font-size: 20px;">!!! Cochez la bonne reponse</label>
                        <select class="form-control" name="bn_reponse" id="bn_reponse">
                        <?php
                            for($i=1; $i<=5; $i++)
                            {
                              ?>
                              <option value="<?php echo $i; ?>">Assertion <?php echo $i; ?></option>
                              <?php
                            }
                            ?>
                            
                        </select>
                  </div>
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit" name="add"><i class="fa fa-fw fa-lg fa-check-circle"></i>Repondre</button>
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