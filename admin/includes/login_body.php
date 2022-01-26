<body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <!-- <div class="logo">
        <h1>EPST</h1>
      </div> -->
      <div class="login-box">
        <form class="login-form" method="POST" action="verify.php">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SE CONNECTER</h3>
          <?php
						if(isset($_SESSION['error'])){
							echo "
								<p style='color: red; text-align: center;'>".$_SESSION['error']."</p> 
							
							";
							unset($_SESSION['error']);
						}
						?>
          <div class="form-group">
            <label class="control-label">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Votre username" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label">Mot de passe</label>
            <input class="form-control" type="password" name="password" placeholder="Votre mot de passe">
          </div>
          <div class="form-group">
            <div class="utility">
              <div class="animated-checkbox">
              </div>
              <p class="semibold-text mb-2"><a href="../inscription.php">N'avez-vous pas un compte ?</a></p><br>
              <p class="semibold-text mb-2"><a href="../index.php">Retour</a></p>
            </div>
          </div>
          <div class="form-group btn-container">
            <!-- <button class="btn btn-primary btn-block" name="connect"><i class="fa fa-sign-in fa-lg fa-fw"></i>CONNECTER</button> -->
            <input class="btn btn-primary btn-block" type="submit" name="connect" class="btn login_btn" value="CONNECTER">
          </div>
        </form>
        <form class="forget-form" action="operation/register.php">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>S'enregistrer</h3>
          <div class="form-group">
            <label class="control-label">Username</label>
            <input class="form-control" type="text" placeholder="Votre nom d'utilisateur">
          </div>
          <div class="form-group">
            <label class="control-label">Quartier</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group">
            <label class="control-label">Avenue</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group">
            <label class="control-label">Numero</label>
            <input class="form-control" type="text" placeholder="Email">
          </div>
          <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control" type="password" placeholder="Email">
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
          </div>
          <div class="form-group mt-3">
            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
          </div>
        </form>
      </div>
    </section>