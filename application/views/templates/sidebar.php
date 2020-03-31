<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url('/dashboard')?>">PIP</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('/dashboard')?>">PIP</a>
          </div>
          <ul class="sidebar-menu">
            <!-- prepare Group Menu -->
            <?php
                $role_id = $this->session->userdata('role_id');
                $queryGroup = "SELECT DISTINCT(user_menu.group)";
                $query = "FROM user_menu JOIN `user_access_menu`
                          ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                          WHERE `user_access_menu`.`role_id` = $role_id
                          ORDER BY user_menu.urutan ASC";
                $grupMenu = $this->db->query($queryGroup.$query)->result_array();
            ?>
            <?php foreach ($grupMenu as $gr) : ?>
              <li class="menu-header"><?= $gr['group'];?></li>
              <?php
                $grup = $gr['group'];
                $queryMenu = "SELECT DISTINCT(user_menu.id), user_menu.menu
                              FROM user_menu JOIN `user_access_menu`
                              ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                              WHERE `user_access_menu`.`role_id` = $role_id AND user_menu.group = '$grup'
                              ORDER BY user_menu.urutan ASC";
                $menu = $this->db->query($queryMenu)->result_array();
                // prepare Menu
                foreach ($menu as $m) :
                  $menuId = $m['id'];
                  $querySubMenu = "SELECT a.*
                                   FROM user_sub_menu a, user_access_menu b
                                   WHERE a.id = b.submenu_id AND b.role_id = '$role_id' AND b.menu_id = '$menuId'
                                    AND `is_active` = 1";
                  $subMenu = $this->db->query($querySubMenu)->row_array();
                  if ( $m['menu'] == $subMenu['title'] ) :
                    $queryID = "SELECT menu_id FROM user_sub_menu WHERE title = '$title' ";
                    $idmenu = $this->db->query($queryID)->row_array();
              ?>
                <!-- Menu with no Dropdown -->
                <li class="nav-item <?php echo $is_active = $subMenu['title'] === $title ? "active" : ""; ?>">
                  <a class="nav-link " href="<?= base_URL($subMenu['url']); ?>">
                    <i class="<?= $subMenu['icon'];?>"></i>
                    <span><?= $subMenu['title'];?></span>
                  </a>
                </li>
              <?php else : ?>
                <!-- Menu with Dropdown -->
                <li class="nav-item dropdown <?php echo $is_active = $m['id'] === $idmenu['menu_id'] ? "active" : ""; ?>">
                  <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="<?= $subMenu['icon'];?>"></i> <span><?= $m['menu'];?></span></a>
                  <ul class="dropdown-menu">
                  <?php
                      $subMenu = $this->db->query($querySubMenu)->result_array();
                      foreach ( $subMenu as $sm ) :
                  ?>
                      <li class="nav-item <?php echo $is_active = $sm['title']==$title ? "active" : ""; ?>">
                        <a class="nav-link"
                           href="<?= base_URL($sm['url']); ?>">
                           <?= $sm['title']; ?>
                        </a>
                      </li>
                    <?php endforeach ?>
                  </ul>
                </li>
              <?php endif; ?>
              
              <?php endforeach ?>
            <?php endforeach ?>
          </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="<?= base_url('auth/logout')?>" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
        </aside>
      </div>
