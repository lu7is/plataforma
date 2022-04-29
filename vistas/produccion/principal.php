<?php
  
 require_once "../../app/modelos/usuariosModel.php";
   
 $modelo = new Usuarios();

 
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
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../dashboard.php">Meraki-Brand</a>
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
                        <li><a class="dropdown-item" href="../auth/cerrar_sesion.php">Cerrar Sesión</a></li>
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
                                    <a class="nav-link" href="usuarios/principal.php">Registrar</a>
                                    <a class="nav-link" href="usuarios/principal.php">Tareas </a>
                                 </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">logistico:</div>
                            <a class="nav-link collapsed" href="#opera" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-signal"></i></div>
                                Bodega 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="opera" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../facturas/principal.php">Registro de mercancia</a>
                                    <a class="nav-link" href="../separacion/principal.php">Separacion </a>
                                    <a class="nav-link" href="tareas/tareas.php">Despachos </a>
                                    
                                    
                                 </nav>
                            </div>
                            

                            <div class="sb-sidenav-menu-heading">Operativo:</div>
                            <a class="nav-link collapsed" href="#opera" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-signal"></i></div>
                                Productividad 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="opera" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../facturas/principal.php">Facturacion</a>
                                    <a class="nav-link" href="tareas/tareas.php">Producción </a>
                                    <a class="nav-link" href="tareas/tareas.php">Nomina </a>
                                    <a class="nav-link" href="tareas/tareas.php">Asistencia </a>
                                    <a class="nav-link" href="tareas/tareas.php">Gastos </a>
                                    
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
              <div class="container-fluid px-4">
              <h1 class="mt-4">Produccion</h1>
                  <button type="button" class= "mt-5 mx-5 btn btn-success" data-bs-toggle="modal" data-bs-target="#registrar" >Registrar</button>
                   <div class="modal fade" id="registrar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Registrar Usuarios</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                        <form method="post" action="" >
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="cedula">Cedula:</label>
                                  <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="Cedula" id="Cedula" placeholder="Cedula" required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control"  name="Nombre" id="Nombre" placeholder="Nombre" required >
                                </div>
                             </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="apellido">Apellido:</label>
                                  <input type="text" class="form-control" name="Apellido" id="Apellido" placeholder="Apellido"required >
                                </div>
                              <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="telefono">Telefono:</label>
                                  <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="Telefono" id="Telefono" placeholder="Telefono" required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <input type="text" class="form-control" name="Direccion" id="Direccion" placeholder="Dirección" required >
                                </div>
                                </div>
                              <div class="form-group col-md-6 p-2">
                                  <label for="correo">Correo:</label>
                                  <input type="email" class="form-control" name="Correo" id="Correo" placeholder="Correo@hotmail.com" required >
                                </div>
                                <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="contraseña">Contraseña:</label>
                                  <input type="password" class="form-control" name="Password" id="Password" placeholder="********">
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <select class="form-select" name="Rol" id="Rol"required >
                                    <option selected>Selecciona El Rol </option>
                                    <option value="administrador">Administrador</option>
                                    <option value="empleado">Empleado</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="proveedor">Proveedor</option>
                                  </select>
                                </div>
                                </div>
                              <br>
                           
                            <button type="button" onclick="Validacion();" class="btn btn-primary">Registrar Usuario</button>
                            <button type="submit" class="btn btn-warning">Cancelar</button>
                          </form>
                        </div>

                      </div>

                    </div>

                  </div>
                  </div>
                  
                  <br>
                  <div class="container">
            
                

                  </div>

                
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
        <script src="../../app/assets/demo/chart-area-demo.js"></script>
        <script src="../../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../../js/datatables-simple-demo.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        
      
      </script>
        
        <script src="../../js/java.js"></script>
       
        
    </body>
</html>