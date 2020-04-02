      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="navbar-nav mr-auto">
          <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
        </div> 
        <form class="form-inline ml-auto"></form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url("assets/")?>/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= $user['username'];?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url('account'); ?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Account
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

              <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?=$title?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item"><?= $bc['group']?></div>
              <?php if ( $bc['menu'] == $bc['title'] ) {?>
                <div class="breadcrumb-item"><?= $bc['menu']?></div>
              <?php } else { ?>
                <div class="breadcrumb-item"><?= $bc['menu']?></div>
                <div class="breadcrumb-item"><?= $bc['title']?></div>
              <?php } ?>

            </div>
          </div>


      