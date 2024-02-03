<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema WEB - Estudio Contable</title>
    <link rel="icon" href="../diseños/logos/logo.png">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Estilos-->
    <link href="../diseños/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../diseños/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../diseños/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../diseños/css/bootstrap-select.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="escritorio.php">
                <div class="sidebar-brand-icon">
                  <!-- <i class="fas fa-laugh-wink"></i> -->
                  <img class="mv-logo-h" src="../diseños/logos/logo.png">
                </div>
                  
                <div class="sidebar-brand-text me-3">ESTUDIO CONTABLE</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Escritorio -->
            <?php
            if ($_SESSION['Escritorio']==1)
            {
                echo '<li class="nav-item" id="nav-li-escritorio">
                        <a class="nav-link" href="escritorio.php">
                          <i class="fas fa-table"></i>
                          <span>Escritorio</span>
                        </a>
                      </li>';
            }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu
            </div>

            <!-- Nav Item - Clientes -->
            <?php
            if ($_SESSION['Clientes']==1)
            {
                echo '<li class="nav-item" id="nav-li-cliente">
                        <a class="nav-link" href="clientes.php">
                          <i class="fas fa-users"></i>
                          <span>Clientes</span>
                        </a>
                      </li>';
            }
            ?>

            <!-- Nav Item - Servicios -->
            <?php
            if ($_SESSION['Servicios']==1)
            {
                echo '<li class="nav-item" id="nav-li-servicio">
                        <a class="nav-link" href="servicios.php">
                          <i class="fas fa-tags"></i>
                          <span>Servicios</span>
                        </a>
                      </li>';
            }
            ?>          

            <!-- Nav Item - Ordenes de Servicio -->
            <?php
            if ($_SESSION['Ordenes de Servicio']==1)
            {
                echo '<li class="nav-item" id="nav-li-ordenservicio">
                        <a class="nav-link" href="ordeneservicio.php">
                          <i class="fas fa-laptop-house"></i>
                          <span>Ordenes de Servicios</span>
                        </a>
                      </li>';
            }
            ?>

            <!-- Nav Item - Ordenes de Trabajo -->
            <?php
            if ($_SESSION['Ordenes de Trabajo']==1)
            {
                echo '<li class="nav-item" id="nav-li-ordentrabajo">
                        <a class="nav-link" href="ordenestrabajo.php">
                          <i class="fas fa-briefcase"></i>
                          <span>Ordenes de Trabajo</span>
                        </a>
                      </li>';
            }
            ?>

            <!-- Nav Item - Pagos -->
            <?php
            if ($_SESSION['Pagos']==1)
            {
                echo '<li class="nav-item" id="nav-li-pago">
                        <a class="nav-link" href="pagos.php">
                          <i class="fas fa-hand-holding-usd"></i>
                          <span>Pagos</span>
                        </a>
                      </li>';
            }
            ?>

            <!-- Nav Item - Gastos -->
            <?php
            if ($_SESSION['Gastos']==1)
            {
                echo '<li class="nav-item" id="nav-li-gasto">
                        <a class="nav-link" href="gastos.php">
                          <i class="fas fa-calculator"></i>
                          <span>Gastos</span>
                        </a>
                      </li>';
            }
            ?>

            <!-- Nav Item - Usuarios -->
            <?php
            if ($_SESSION['Usuarios']==1)
            {
                echo '<li class="nav-item" id="nav-li-usuario">
                        <a class="nav-link" href="usuarios.php">
                          <i class="fas fa-user-tie"></i>
                          <span>Usuarios</span>
                        </a>
                      </li>';
            }
            ?>            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Reportes
            </div>

            <!-- Nav Item - Pages Collapse Consultas -->
            <?php
            if ($_SESSION['Consultas']==1)
            {
                echo '<li class="nav-item" id="nav-li-consulta">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                          <i class="fas fa-fw fa-folder"></i>
                          <span>Consultas</span>
                        </a>
                        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                          <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Consultas:</h6>
                            <a class="collapse-item" href="consultaclientes.php">Clientes</a>
                            <a class="collapse-item" href="consultaordeneservicios.php">Ordenes de servicios</a>
                            <a class="collapse-item" href="consultapagos.php">Pagos</a>
                            <a class="collapse-item" href="consultagastos.php">Gastos</a>
                            <a class="collapse-item" href="consultausuarios.php">Usuarios</a>
                            <div class="collapse-divider"></div>
                          </div>
                        </div>
                      </li>';
            }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="ordenestrabajo.php" id="alertsDropdown" role="button">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter" id="spantpendientes"></span>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nombre'];?></span>
                                <img class="img-profile rounded-circle"
                                src="../archivos/perfil_usuarios/<?php echo $_SESSION['imagen']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="escritorio.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="ordenestrabajo.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mis Trabajos
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../controladores/usuarios.php?op=salir">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">