<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SenacSS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"> <?php echo $_SESSION["nome_usuario"]; ?> </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="./" class="nav-link active">
            <i class="nav-icon bi bi-house"></i>
            <p>
              Página Inicial
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./ordens-servico" class="nav-link">
            <i class="nav-icon bi bi-cash-coin text-success"></i>
            <p>
              Ordens de Serviço
              <span class="right badge badge-warning">15</span>
            </p>
          </a>
        </li>
        <li class="nav-header">CONFIGURAÇÕES</li>
        <li class="nav-item">
          <a href="./clientes" class="nav-link">
            <i class="nav-icon bi bi-people"></i>
            <p>
              Clientes
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./servicos" class="nav-link">
            <i class="nav-icon fas bi bi-tools"></i>
            <p>
              Serviços
            </p>
          </a>
          <ul class="nav nav-treeview">
          </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>