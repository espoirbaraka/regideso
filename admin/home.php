<?php
include("includes/sessionconnected.php");

include("includes/head.php");

include("includes/navbar_menubar.php");
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="home.php">Acceuil</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-list fa-3x"></i>
            <div class="info">
              <h4>Menages</h4>
              <?php
              $stmt = $conn->prepare("SELECT COUNT(IdMenage) as nbre FROM t_menage");
              $stmt->execute();
              $row = $stmt->fetch();
              $nbre=$row['nbre'];
              ?>
              <p><b><?php echo $nbre; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-book fa-3x"></i>
            <div class="info">
              <h4>Agents</h4>
              <?php
              $stmt = $conn->prepare("SELECT COUNT(IdAgent) as nbre FROM t_agent");
              $stmt->execute();
              $row = $stmt->fetch();
              $nbre2=$row['nbre'];
              ?>
              <p><b><?php echo $nbre2; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Communes couvertes</h4>
              <?php
              $stmt = $conn->prepare("SELECT COUNT(CodeCommune) as nbre FROM t_commune");
              $stmt->execute();
              $row = $stmt->fetch();
              $nbre3=$row['nbre'];
              ?>
              <p><b><?php echo $nbre3; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4>Quartiers couverts</h4>
              <?php
              $stmt = $conn->prepare("SELECT COUNT(CodeQuartier) as nbre FROM t_quartier");
              $stmt->execute();
              $row = $stmt->fetch();
              $nbre4=$row['nbre'];
              ?>
              <p><b><?php echo $nbre4; ?></b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Recette mensuelle</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
      </div>
    </main>
   <?php
   include("includes/script.php");
   ?>