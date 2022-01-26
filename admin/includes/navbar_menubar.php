<?php
$id = $_SESSION['privilege'];
?>
<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="home.php" style="font-weight: bold;">REGIDESO</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <li class="app-search">
          <input class="app-search__input" type="search" placeholder="Search">
          <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="#"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo (!empty($user['Photo'])) ? 'images/images_db/'.$user['Photo'] : 'images/user.png'; ?>" alt="User Image" style="width: 100%; max-width: 45px; height: auto;">
        <div>
          <p class="app-sidebar__user-name" style="text-transform: lowercase; font-weight: bold;"><?php echo $user['Username'].'  ::'.$user['Fonction']; ?></p>
        </div>
      </div>
      <ul class="app-menu">
      
        <li><a class="app-menu__item" href="home.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <?php
        if($_SESSION['privilege']==1)
        {
          ?>
          <li><a class="app-menu__item" href="agent.php"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Agents</span></a></li>
          <li><a class="app-menu__item" href="commune.php"><i class="app-menu__icon fa fa-list"></i><span class="app-menu__label">Commune</span></a></li>
          <?php
        }
        
        ?>

        <?php
        if($id == 1 || $id==3)
        {
          ?>
          <li><a class="app-menu__item" href="menage.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Menages</span></a></li>
          <?php
        }
        
        ?>
        
        <li><a class="app-menu__item" href="rapport.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Rapport</span></a></li>
        <?php
        if($id == 1 || $id==2)
        {
          ?>
          <li><a class="app-menu__item" href="recette.php"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Recettes</span></a></li>
          <?php
        }
        ?>
        
        
        
      </ul>
    </aside>