<?php
  
 require_once "../../app/modelos/usuariosModel.php";
   


 
 session_start();
 $id= $_SESSION['id_usuario'];
 if($id == null ){
  echo' 
  header("location:auth/index.php");
  <script> 
              alert("Correo o contraseña Errado");
              window.location = "auth/index.php";
  </script>
  ';
 }
 $nombre = $_SESSION['nombre'];
 $apellido = $_SESSION['apellido'];
 $rol = $_SESSION['rol'];
 $proveedores = new Usuarios();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Pedidos - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <!-- Icons para importarlos -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
        <!-- estilos de plantilla -->
        <link href="../../css/styles.css" rel="stylesheet" />
        <!-- estilos propios-->
        <link href="../../css/usuarios.css" rel="stylesheet" />
        <!--  extension responsive  -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
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
                                <div class="sb-nav-link-icon"><i id="taco" class="fas fa-tachometer-alt"></i></div>
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
                                    <a class="nav-link" href="../tareas/principal.php">Registrar</a>
                                    <a class="nav-link" href="../tareas/tareas.php">Tareas </a>
                                 </nav>
                            </div>
                            <?php if($rol == 'bodega' || $rol == 'administrador' || $rol== 'cliente' || $rol == 'supervisor') { ?>
                            <div class="sb-sidenav-menu-heading">Logistico:</div>
                            <a class="nav-link collapsed" href="#bode" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Bodegas 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="bode" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                   <?php if($rol == 'administrador' || $rol== 'bodega' || $rol== 'cliente' || $rol == 'supervisor'  ) { ?>
                                    <a class="nav-link" href="../bodegas/principal.php">Registrar</a>
                                    <?php } ?>
                                    <?php if($rol == 'super' ) { ?>
                                    <a class="nav-link" href="separacion/principal.php">Separacion </a>
                                    <?php } ?>
                                    <?php if($rol == 'super'  ) { ?>
                                    <a class="nav-link" href="../despacho/principal.php">Despachos </a>
                                    <?php } ?>
                                 </nav>
                            </div>
                            <?php }?>  
                            <?php if($rol == 'administrador' || $rol == 'supervisor' ) { ?>
                            <div class="sb-sidenav-menu-heading">Operativo:</div>
                            <a class="nav-link collapsed" href="#opera" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-signal"></i></div>
                                Productividad 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="opera" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php if($rol == 'administrador' ) { ?>
                                    <a class="nav-link" href="facturacion/principal.php">Facturacion</a>
                                    <?php } ?>
                                    <?php if($rol == 'super' ) { ?>
                                    <a class="nav-link" href="produccion/principal.php">Producción </a>
                                    <?php } ?>
                                    <?php if($rol == 'super' ) { ?>
                                    <a class="nav-link" href="nomina/principal.php">Nomina </a>
                                    
                                    <a class="nav-link" href="asistencia/principal.php">Asistencia </a>
                                    <?php } ?>
                                    <a class="nav-link" href="../gastos/principal.php">Gastos </a>
                                    
                                 </nav>
                            </div>
                            <?php } ?>
                            <?php if($rol == 'administrador' || $rol == 'proveedor' || $rol == 'supervisor') { ?>
                            <div class="sb-sidenav-menu-heading">Materia prima:</div>
                            <a class="nav-link collapsed" href="#prove" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-pen"></i></div>
                                Proveedores 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="prove" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <?php if($rol == 'administrador' || $rol == 'supervisor' ) { ?>
                                  <a class="nav-link" href="../pedidos/principal.php">Pedidos </a>
                                <?php } ?>
                                <?php if($rol == 'super' ) { ?>
                                    <a class="nav-link" href="inventario/principal.php">Inventario </a>
                                    <?php } ?>
                                 </nav>
                            </div>
                            <?php } ?>
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
              <h1 class="mt-4"> <i class="material-icons">import_contacts</i> Pedidos</h1>
                  <button type="button" class= "mt-5 mx-5 btn btn-success" data-bs-toggle="modal" data-bs-target="#registrar" ><i class="material-icons">library_add</i>Registrar</button>
                   <div class="modal fade" id="registrar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Registrar Pedido</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="regi_pedi" >
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Opservacion:</label>
                                  <select class="form-select" name="" id="Opservacion" >
                                    <option >Selecciona un campo</option>
                                    <option value="contado">Contado</option>
                                    <option value="credito">Credito</option>
                                  </select>
                                </div>
                             </div>                                                         
                                <div class="form-row d-flex">
                                    <div class="form-group col-md-6 p-2">
                                        <label for="apellido">Descripción:</label>
                                        <textarea id="Descripcion" cols="20" rows="10" class="form-control" placeholder="Descripción"></textarea>
                                    </div>
                                    <div class="form-group col-md-6 p-2">                                
                                        <label for="direccion">Proveedor:</label>
                                        <select class="form-select" name="Cliente" id="Proveedor">
                                        <option selected>Selecciona el proveedor </option>
                                            <?php 
                                                $proveedor = $proveedores->List_Proveedor();
                                                if($proveedor !=null){ 
                                                    foreach($proveedor as $provee){ 
                                            ?>
                                            <option value="<?php echo $provee['id_usuario']; ?>"><?php echo $provee['nombre']; ?></option>
                                            <?php 
                                            } 
                                            }
                                   ?>
                                        </select>
                                    </div>
                                </div>
                              <br>
                            <button type="submit"  class="btn btn-primary">Registrar Usuario</button>
                            <button type="button" class="btn btn-warning">Cancelar</button>
                          </form>
                        </div>

                      </div>
                      

                    </div>
                                    
                  </div><br><br>
                  <!-- EMPIEZA LA TABLA DE LOS PEDIDOS -->
                  <div class="container">
                  <table class="table table-striped table-bordered table-condensed" style="width:100%" id="tablaPedido">
                  <thead class="text-center">
                    <tr>
                    <th>Id</th>
                    <th>Opservación</th>
                      <th>Descripción</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Proveedor</th>                   
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>
                    </tbody>
                  </table>

                  <!-- EMPIEZA LA TABLA DE editar LOS PEDIDOS -->
                  <div class="modal fade" id="editar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalTitle">Editar Pedido</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="edi_pedido" >
                          <input type="hidden" id="id">
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                  <label for="direccion">Opservacion:</label>
                                  <select class="form-select" name="" id="opservacion" >
                                    <option >Selecciona un campo</option>
                                    <option value="contado">Contado</option>
                                    <option value="credito">Credito</option>
                                  </select>
                                </div>
                             </div>                                                         
                                <div class="form-row d-flex">
                                    <div class="form-group col-md-6 p-2">
                                        <label for="apellido">Descripción:</label>
                                        <textarea id="descripcion" cols="20" rows="10" class="form-control" placeholder="Descripción"></textarea>
                                    </div>
                                    <div class="form-group col-md-6 p-2">                                
                                        <label for="direccion">Proveedor:</label>
                                        <select class="form-select" name="Cliente" id="proveedor">
                                        <option selected>Selecciona el proveedor </option>
                                            <?php 
                                                $proveedor = $proveedores->List_Proveedor();
                                                if($proveedor !=null){ 
                                                    foreach($proveedor as $provee){ 
                                            ?>
                                            <option value="<?php echo $provee['id_usuario']; ?>"><?php echo $provee['nombre']; ?></option>
                                            <?php 
                                            } 
                                            }
                                   ?>
                                        </select>
                                    </div>
                                </div>
                              <br>
                            <button type="submit"  class="btn btn-primary">Registrar Usuario</button>
                            <button type="button" class="btn btn-warning">Cancelar</button>
                          </form>
                        </div>

                      </div>
                      

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
                  <script src="../../js/pedido.js"></script>
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
                  <!-- extension responsive -->
                  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>                          
                </body>
</html>