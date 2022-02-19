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
                            <div class="sb-sidenav-menu-heading">Inicio</div>
                            <a class="nav-link" href="../dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Pagina Principal
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="usuarios/index.php">Ver Todo</a>
                                    
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Bodegas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Index
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="../tables.html">futuro</a>   
                                        </nav>
                                    </div>
                                    
                                    
                                </nav>
                            </div>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Proveedores
                            </a>
                            
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
              <h1 class="mt-4">Editar Usuarios</h1>
                 <?php
                   $id = $_GET['id'];
                   $Editar = $modelo->Listar_Id($id);       
                 ?>
                  
                  <br>
                  <div class="container">
                    <form method="post" action="../../app/controladores/editarUsuario.php" >
                          <div class="form-group col-md-6 p-2">
                            <input type="text" name="Id" class="form-control" value="<?php echo $id; ?>" >
                          </div>
                                <?php
                                if($Editar !=null){
                                    foreach($Editar as $edi){ 
                                ?>
                                <div class="form-row d-flex">
                            
                                <div class="form-group col-md-6 p-2">
                                  <label for="cedula">Cedula:</label>
                                  <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="Cedula" value="<?php echo $edi['cedula']; ?>" id="cedula" placeholder="Cedula" required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control"  name="Nombre" id="Nombre" placeholder="Nombre" value="<?php echo $edi['nombre']; ?>" required >
                                </div>
                             </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="apellido">Apellido:</label>
                                  <input type="text" class="form-control" name="Apellido" id="Apellido" value="<?php echo $edi['apellido']; ?>" placeholder="Apellido"required >
                                </div>
                              <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="telefono">Telefono:</label>
                                  <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="Telefono" id="telefono" value="<?php echo $edi['telefono']; ?>" placeholder="Telefono" required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <input type="text" class="form-control" name="Direccion" id="direccion" placeholder="Dirección" value="<?php echo $edi['direccion']; ?>" required >
                                </div>
                                </div>
                              <div class="form-group col-md-6 p-2">
                                  <label for="correo">Correo:</label>
                                  <input type="email" class="form-control" name="Correo" id="correo" placeholder="Correo@hotmail.com" value="<?php echo $edi['correo']; ?>" required >
                                </div>
                                <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="contraseña">Contraseña:</label>
                                  <input type="password" class="form-control" name="Password" id="password" value="<?php echo $edi['password']; ?>" placeholder="********">
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <select class="form-select" name="Rol" required >
                                    <option selected value="<?php echo $edi['rol']; ?>"><?php echo $edi['rol']; ?></option>
                                    <option value="administrador">Administrador</option>
                                    <option value="empleado">Empleado</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="proveedor">Proveedor</option>
                                  </select>
                                </div>
                                </div>
                              <br>
                           <?php
                                    }
                                }
                           ?>
                            <button type="submit" class="btn btn-primary">Editar Usuario</button>
                            <a href="principal.php"><button type="button" class="btn btn-warning">Cancelar</button></a>
                          </form>


                  </div>

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
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../js/java.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
    </body>
</html>
