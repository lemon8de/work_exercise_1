<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="../../dist/img/logo_ico.ico" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Exercise1 | Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="row">
            <div class="col-sm-3 d-flex align-items-center">
                <div class="image">
                    <img src="../../dist/img/user.png" class="img-circle elevation-2" alt="User Image">
                </div>
            </div>
            <div class="col-sm-9">
                <div class="info">
                <a href="dashboard.php" class="d-block"><?=htmlspecialchars($_SESSION['name']) . '</br>' . $_SESSION['id_number'] . '</br>' . $_SESSION['section'] . ' | ' . $_SESSION['position'];?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link"><i class="nav-icon fas fa-address-book"></i><p>Dashboard</p></a>
            </li>

            <li class="nav-item menu-is-opening menu-open">
                <a href="#" class="nav-link"><i class="nav-icon far fa-envelope"></i><p>Alerts<i class="fas fa-angle-left right"></i></p></a>
                <ul class="nav nav-treeview" style="display: block;">
                    <li class="nav-item">
                        <a href="alert/view.html" class="nav-link"><i class="fas fa-book nav-icon"></i><p>View</p></a>
                    </li>
                    <li class="nav-item">
                        <a href="mailbox/create.html" class="nav-link"><i class="fas fa-plus nav-icon"></i><p>Create</p></a>
                    </li>
                    <li class="nav-item">
                        <a href="mailbox/dismiss.html" class="nav-link"><i class="fas fa-times nav-icon"></i><p>Dismiss</p></a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="sample1.php" class="nav-link"><i class="nav-icon fas fa-user-cog"></i><p>Sample 1</p></a>
            </li>

            <li class="nav-item">
                <a href="accounts.php" class="nav-link"><i class="nav-icon fas fa-user-cog"></i><p>Account Management</p></a>
            </li>

            <li class="nav-item">
                <?php include '../../logout.php';?>
            </li>
      </ul>
    </nav>
</aside>
</div> <!-- this closes the div wraper in the navbar.php -->