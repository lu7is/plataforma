<?php
  
 require_once "../../app/modelos/usuariosModel.php";
   
 $modelo = new Usuarios();

 
 session_start();
 $id= $_SESSION['id_usuario'];
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
        <!-- Icons para importarlos -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
        <!-- estilos de plantilla -->
        <link href="../../css/styles.css" rel="stylesheet" />
        <!-- estilos propios-->
        <link href="../../css/usuarios.css" rel="stylesheet" />
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
                            <?php if($rol == 'administrador' || $rol == 'supervisor' ) { ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <?php } ?>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#">Usuarios Registrados</a>
                                 </nav>
                            </div>
                            <a class="nav-link collapsed" href="#tarea" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Tareas
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="tarea" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../tareas/principal.php">Registrar</a>
                                    <a class="nav-link" href="../tareas/tareas.php">Tareas </a>
                                 </nav>
                            </div>
                            
                            <div class="sb-sidenav-menu-heading">logistico:</div>
                            <a class="nav-link collapsed" href="#logist" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Bodegas 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="logist" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../bodegas/principal.php">Registrar</a>
                                    <a class="nav-link" href="../separacion/principal.php">Separacion </a>
                                    <a class="nav-link" href="../despacho/principal.php">Despachos </a>
                                    
                                    
                                 </nav>
                            </div>
                            

                            <?php if($rol == 'administrador' ) { ?>
                            <div class="sb-sidenav-menu-heading">Operativo:</div>
                            <a class="nav-link collapsed" href="#opera" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-signal"></i></div>
                                Productividad 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="opera" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../facturacion/principal.php">Facturacion</a>
                                    <a class="nav-link" href="../produccion/principal.php">Producción </a>
                                    <a class="nav-link" href="../nomina/principal.php">Nomina </a>
                                    <a class="nav-link" href="../asistencia/principal.php">Asistencia </a>
                                    <a class="nav-link" href="../gastos/principal.php">Gastos </a>
                                    
                                 </nav>
                            </div>
                            <?php } ?>
                            <div class="sb-sidenav-menu-heading">Materia prima:</div>
                            <a class="nav-link collapsed" href="#mate" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-pen"></i></div>
                                Proveedores 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="mate" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../proveedores/principal.php">Registrar</a>
                                    <a class="nav-link" href="../pedidos/principal.php">Pedidos </a>
                                    <a class="nav-link" href="../inventario/principal.php">Inventario </a>
                                    
                                    
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
              <h1 class="mt-4">Usuarios Registrados</h1>
              <!-- EMPIEZA EL FORMULARIO REGISTRAR -->
              <button type="button" class= "mt-5 mx-5 btn btn-success " data-bs-toggle="modal" data-bs-target="#registrar" ><i class="material-icons">library_add</i>  Registrar Usuario</button>
                  <div class="modal fade" id="registrar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Registrar Usuarios</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                        <form  id="form-usu" >
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="cedula" class="control-label">Cedula:</label>
                                  <input type="number" class="form-control" minlength="8"  pattern="^[0-9]+" name="Cedula" id="Cedula" placeholder="Cedula"  >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control"  name="Nombre" id="Nombre" placeholder="Nombre"  >
                                </div>
                             </div>
                                <div class=" col-md-6 p-2">
                                  <label for="apellido">Apellido:</label>
                                  <input type="text" class="form-control" name="Apellido" id="Apellido" placeholder="Apellido" >
                                </div>
                              <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="telefono">Telefono:</label>
                                  <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="Telefono" id="Telefono" placeholder="Telefono"  >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <input type="text" class="form-control" name="Direccion" id="Direccion" placeholder="Dirección"  >
                                </div>
                                </div>
                              <div class="form-group col-md-6 p-2">
                                  <label for="correo">Correo:</label>
                                  <input type="email" class="form-control" name="Correo" id="Correo" placeholder="Correo@hotmail.com"  >
                                </div>
                                <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="contraseña">Contraseña:</label>
                                  <input type="password" class="form-control" name="Password" id="Password" >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <select class="form-select" name="Rol" id="Rol" >
                                    <option selected id="Rol" >Selecciona El Rol </option>
                                    <option value="administrador">Administrador</option>
                                    <option value="empleado">Empleado</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="proveedor">Proveedor</option>
                                    <option value="bodega">Bodega</option>
                                    <option value="supervisor">Supervisor</option>
                                  </select>
                                </div>
                                </div>
                              <br>
                           
                            <button type="submit" id="registrar" class="btn btn-primary">Registrar Usuario</button>
                            <button type="button" id="cancelar"  data-bs-dismiss="modal" aria-label="close"  class=" btn btn-warning">Cancelar</button>
                          </form>
                        </div>

                      </div>

                    </div>

                  </div>
                  </div>
                  
                  <br>
                  <!-- EMPIEZA LA TABLA DE LOS USUARIOS -->
                  <div class="container">
                  <table class="table table-striped table-bordered table-condensed" style="width:100%" id="tablaUsuarios">
                  <thead class="text-center">
                    <tr>
                    <th>Id</th>
                    <th>Cedula</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Telefono</th>
                      <th>Dirección</th> 
                      <th>Correo</th> 
                      <th>Rol</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>
                    </tbody>
                  </table>
                 
                  </div>
                  <!-- EMPIEZA FORMULARIO EDITAR USUARIOS-->
                  <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Editar Usuarios</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                        <form  id="form_Edit" >
                          <input type="hidden" id=id>
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="cedula">Cedula:</label>
                                  <input type="number" class="form-control" minlength="8" pattern="^[0-9]+" name="Cedula" id="cedula" placeholder="Cedula" required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control"  name="Nombre" id="nombre" placeholder="Nombre" required >
                                </div>
                             </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="apellido">Apellido:</label>
                                  <input type="text" class="form-control" name="Apellido" id="apellido" placeholder="Apellido"required >
                                </div>
                              <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="telefono">Telefono:</label>
                                  <input type="number" class="form-control" min="1" pattern="^[0-9]+" name="Telefono" id="telefono" placeholder="Telefono" required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <input type="text" class="form-control" name="Direccion" id="direccion" placeholder="Dirección" required >
                                </div>
                                </div>
                              <div class="form-group col-md-6 p-2">
                                  <label for="correo">Correo:</label>
                                  <input type="email" class="form-control" name="Correo" id="correo" placeholder="Correo@hotmail.com" required >
                                </div>
                                <div class="form-row d-flex">
                                
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Dirección:</label>
                                  <select class="form-select" name="Rol" id="rol"required >
                                    <option selected>Selecciona El Rol </option>
                                    <option value="administrador">Administrador</option>
                                    <option value="empleado">Empleado</option>
                                    <option value="cliente">Cliente</option>
                                    <option value="proveedor">Proveedor</option>
                                    <option value="bodega">Bodega</option>
                                    <option value="supervisor">Supervisor</option>
                                  </select>
                                </div>
                                </div>
                              <br>
                           
                            <button type="submit" id="registrar" class="btn btn-primary">Editar Usuario</button>
                            <button type="submit"  data-bs-dismiss="modal"  class=" btn btn-warning">Cancelar</button>
                          </form>
                        </div>

                      </div>

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
                   <!-- boopstrap para los tooglews -->           
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                  <script src="../../js/scripts.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                  <script src="../../app/assets/demo/chart-area-demo.js"></script>
                  <script src="../../app/assets/demo/chart-bar-demo.js"></script>
                  
                  <script src="../../js/datatables-simple-demo.js"></script>
                  <!-- script para el jquery -->
                  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
                  <!-- AQUI LISTAMOS NUESTRO ARCHIVO JS -->
                  <script src="../../js/usuarios.js"></script>
                  <!-- aqui importamos css local -->
                   <!-- jQuery, Popper.js, Bootstrap JS -->
                  <script src="../../app/assets/jquery/jquery-3.3.1.min.js"></script>
                  <script src="../../app/assets/popper/popper.min.js"></script>
                  <script src="../../app/assets/bootstrap/js/bootstrap.min.js"></script>
                    
                  <!-- datatables JS -->
                  <script type="text/javascript" src="../../app/assets/datatables/datatables.min.js"></script> 

                  <!-- jquery validate --> 
                  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
                  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
                  <script type="text/javascript" src="../../app/assets/jquery/jquery.validate.min.js"></script>             
                  <!-- sweet alert JS -->
                  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                 
                  <!-- Include all compiled plugins (below), or include individual files as needed -->
                  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
                  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
                    

      

      
        
        
       
        
    </body>
</html>
