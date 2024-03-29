<?php
  
 require_once "../../app/modelos/usuariosModel.php";
   
 $modelo = new Usuarios();

 
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
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <!-- Icons para importarlos -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../../css/styles.css" rel="stylesheet" />
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
                                    <a class="nav-link" href="gastos/principal.php">Gastos </a>
                                    
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
              <h1 class="mt-4">Gastos</h1>
                  <button type="button" class= "mt-5 mx-5 btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_registrar" > <i class="material-icons">library_add</i> Registrar</button>
                   <div class="modal fade" id="modal_registrar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header"><br>
                          <h5 class="modal-title" id="modalTitle">Registrar Usuarios</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="regi-gasto">
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                <label for="valor">Valor:</label>
                                  <input type="number" class="form-control" name="Valor" id="Valor" min="1" pattern="^[0-9]+" placeholder="$Valor"required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                <label for="categoria">Concepto:</label>
                                  <select class="form-select" name="Concepto" id="Concepto"required >
                                    <option selected>Selecciona Concepto </option>
                                    <option value="pinturas">Pinturas</option>
                                    <option value="bolsas">Bolsas</option>
                                    <option value="fijo">Fijo</option>
                                    <option value="varios">Varios</option>
                                    <option value="insumos">Insumos</option>
                                    
                                  </select>
                                </div>
                             </div>
                             <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                 
                                <label for="direccion">Proveedor:</label>
                                  <select class="form-select" name="Cliente" id="Proveedor"  >

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
                           
                            <button type="submit"  id="registrar" class="btn btn-primary" >Registrar Gasto </button>
                            <button type="submit" class="btn btn-warning">Cancelar</button>
                          </form>
                        </div>
                    </div>
                </div>  
            </div>     
        <div><br>
             <!-- EMPIEZA LA TABLA DE LOS GASTOS -->            
             <div class="container">
                  <table class="table table-striped table-bordered table-condensed" style="width:100%" id="tablaGasto">
                  <thead class="text-center">
                    <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Concepto</th>
                      <th>Valor</th>
                      <th>Proveedor</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                    <tbody>
                    </tbody>
                  </table>
                 
                  </div>
                        <!-- TERMINA LA TABLA GASTO --> 
                    </div>
                    <div class="modal fade" id="modal_editar" tabindex="-1" aria-hidden="true" aria-labelledby="modalTitle">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header"><br>
                          <h5 class="modal-title" id="modalTitle">Editar Usuarios</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>
                        <div class="modal-body">
                        <form id="edit-gasto">
                          <input type="hidden" id="id">
                            <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                <label for="valor">Valor:</label>
                                  <input type="number" class="form-control" name="Valor" id="valor" min="1" pattern="^[0-9]+" placeholder="$Valor"required >
                                </div>
                                <div class="form-group col-md-6 p-2">
                                <label for="categoria">Concepto:</label>
                                  <select class="form-select" name="Concepto" id="concepto"required >
                                    <option selected>Selecciona Concepto </option>
                                    <option value="pinturas">Pinturas</option>
                                    <option value="bolsas">Bolsas</option>
                                    <option value="fijo">Fijo</option>
                                    <option value="varios">Varios</option>
                                    <option value="insumos">Insumos</option>
                                    
                                  </select>
                                </div>
                             </div>
                             <div class="form-row d-flex">
                                <div class="form-group col-md-6 p-2">
                                 
                                <label for="direccion">Proveedor:</label>
                                  <select class="form-select" name="Cliente" id="proveedor"  >

                                    <option selected>Selecciona el cliente </option>
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
                           
                            <button type="submit"  id="registrar" class="btn btn-primary" >Registrar Gasto </button>
                            <button type="submit" class="btn btn-warning">Cancelar</button>
                          </form>
                        </div>
                    </div>
                </div>  
            </div>     
        <div><br>
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
        <script src="../../app/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../../js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="../../js/gasto.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../js/datatables-simple-demo.js"></script>
        <!-- datatables JS -->
        <script type="text/javascript" src="../../app/assets/datatables/datatables.min.js"></script>     
        <!-- extension responsive -->
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>                                   
    
    
    </body>
</html>