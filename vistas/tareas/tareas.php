<?php
session_start();
$id= $_SESSION['id'];
if($id == null ){
    header("location:auth/index.php");
}
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$rol = $_SESSION['rol'];

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard-MRK</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../../css/styles.css" rel="stylesheet" />
       
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">Meraki-Brand</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $nombre  ?><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuración</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="auth/cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                        <div class="sb-sidenav-menu-heading">Inicio:</div>
                            <a class="nav-link" href="../dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pagina Principal
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../usuarios/principal.php">Usuarios Registrados</a>
                                 </nav>
                            </div>
                            <a class="nav-link collapsed" href="#tarea" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Tareas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="tarea" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="tareas/principal.php">Registrar</a>
                                    <a class="nav-link" href="usuarios/principal.php">Tareas </a>
                                 </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Logistico:</div>
                            
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div> 
                                Bodegas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> <i class="fa-solid fa-cheese"></i>
                            </a>

                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Registrar  
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Separación
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Despachos
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Operativo:</div>
                            <a class="nav-link collapsed" href="#pro" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-signal"></i></div>
                                Productividad 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="pro" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Producción 
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Nomina
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Asistencia
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Gastos
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                </nav>
                            </div>


                            <div class="sb-sidenav-menu-heading">Materia prima:</div>
                            
                            <a class="nav-link collapsed" href="#mate" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Proveedores 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="mate" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Registrar 
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Pedidos
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Inventario
                                        <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                                    </a>
                                   
                                </nav>
                            </div> 
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Login por:</div>
                        <?php echo $nombre, " ", $apellido," ",
                        "Rol:"," ", $rol; ?>
                    </div>
                </nav>
            </div>
            <!-- empieza la pagina principal -->
<div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-6">
            <h1 class="mt-4">Listado de tareas</h1>
                <div class="form-row d-flex">
                            <div class="form-group col-md-6 p-2">    
                                 <input type="Search" class="form-control" min="1" pattern="^[0-9]+" id="Nombre" placeholder="Buscar" required >
                            </div>
                            

                                <div class="form-group col-md-6 p-2">
                                    <button class="btn btn-success my-2 my-sm-0 " type="submit" >
                                        Buscar
                                    </button>
                                </div>
                 </div> 

                 <div class="card my-4 "  id="resultado" >
                                <div class="card-body">
                                    <ul id="container">

                                    </ul>
                                </div>
                            </div>
                 <div class="container p-4">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" id="task-form"> 
                                             <div class="form-group">
                                                 <input type="text" id="name" placeholder="Nueva tarea" class="form-control">
                                             </div> <br>
                                             <div class="form-group">
                                                 <textarea name="" id="descripcion" cols="30" rows="10" class="form-control" placeholder="Descripción"></textarea>
                                             </div> <br>
                                             <button type="submit" class="btn btn-primary btn-block text-center">Guardar Tarea</button> 
                                             <input type="hidden" id="guardar" name="guardar" value="guardar">
                                            </form>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    
           
                    


        </div>

                   





















                </main>
                
                
                <footer class="py-4 bg-grey mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Sitio Web MRK-BRAND</div>
                          
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../../assets/demo/chart-area-demo.js"></script>
        <script src="../../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../../js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="../../js/app.js"></script>
    </body>
</html>