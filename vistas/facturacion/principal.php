<?php
session_start();
require_once('../../app/modelos/usuariosModel.php');
echo $id= md5($_SESSION['id']);
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

$clientes = new Usuarios();
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
        <link href="../../css/factura.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">Meraki_Brand</a>
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
                            <?php if($rol == 'administrador' ) { ?>
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

                            <div class="sb-sidenav-menu-heading">Logistico:</div>
                            
                            <a class="nav-link collapsed" href="#bode" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                                Bodegas 
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="bode" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
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

            <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-2"><i class="fas fa-cube"></i>Facturación</h1>
                        <form id="fact">
                           
    

                            <div class="form-row d-flex">
                            <div class="form-group col-md-2 p-2">
                                    <label for="telefono">Fecha:</label>
                                    <input type="date" class="form-control" min="1" pattern="^[0-9]+" name="Fecha" id="Fecha" placeholder="Fecha" required >
                            </div>
                            <div class="form-group col-md-3 p-2">
                                    <label for="direccion">Cliente:</label>
                                        <select class="form-select" name="Cliente" id="Cliente"required >
                                        
                                            <option selected>Selecciona El Cliente </option>
                                            <?php 
                                                $cliente = $clientes->List_Clientes();
                                                if($cliente !=null){ 
                                                    foreach($cliente as $client){ 
                                            ?>
                                        <option value="<?php echo $client['id']; ?>"><?php echo $client['nombre']; ?></option>
                                            <?php 
                                            }  

                                            }
                                        ?>
                                        </select>
                            
                                 </div>
                              <div class="form-group col-md-3 p-2">                      
    
                                <div id="op">

                                </div>
                             </div>
                            </div><br>
            
                    
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered table-hover" id="">	
        <tr>
           
            <th width="15%">Cantidad</th>
            <th width="38%">Descripción</th>
            <th width="15%">Precio Unitario</th>								
            <th width="15%">Monto</th>
            <th width="38%">Acciones</th>
        </tr>							
        <tr>
           
            <td><input type="text" name="Cantidad" id="Cantidad" class="form-control" autocomplete="off" disabled></td>
            <td><input type="text" name="Descripcion" id="Descripcion" class="form-control" autocomplete="off"></td>			
            <td><input type="number" name="Precio" id="Precio" class="form-control quantity" autocomplete="off"></td>
            <td><input type="number" name="Monto" id="Monto" class="form-control price" autocomplete="off"></td>
            <td>
    
    <button class="btn btn-success" id="addRows" type="button" disabled inline>+ Agregar</button>
</td>

<button class="btn btn-danger delete" id="removeRows" type="button" inline>- Borrar</button> 
        </tr>						 
    </table>
</div>


<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <table class="table table-bordered table-hover" id="invoiceItem">	
        <tr>
            <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
            <th width="15%">Cantidad</th>
            <th width="38%">Descripción</th>
            <th width="15%">Precio Unitario</th>								
            <th width="15%">Monto</th>
        </tr>							
        <tr>
            <div id="list_temp">
                
             <input type="month">    
             <input type="range">  
             <input type="reset">  

            </div>

        </tr>						 
    </table>
</div>


<!-- AQUI TERMINA LA FACTURA-->
<div class="row">
<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8"><br>
    <h3>Observaciónes:</h3>
    <div class="form-group">
        <textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Escribe aqui..."></textarea>
    </div>
    <br>
    <div class="form-group">
        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">
        <input data-loading-text="Guardando factura..." type="submit" name="invoice_btn" value="Guardar Factura" class="btn btn-success submit_btn invoice-save-btm">						
    </div>

    
</div>
<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
    <span class="form-inline">						
        <div class="form-group">
            <label>Total: &nbsp;</label>
            <div class="input-group">
                <div class="input-group-addon currency"></div>
                <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
            </div>
        </div>
        <div class="form-group">
            <label>Cantidad pagada: &nbsp;</label>
            <div class="input-group">
                <div class="input-group-addon currency"></div>
                <input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Cantidad pagada">
            </div>
        </div>
        <div class="form-group">
            <label>Cantidad debida: &nbsp;</label>
            <div class="input-group">
                <div class="input-group-addon currency"></div>
                <input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Cantidad debida">
            </div>
        </div>
    </span>
</div>
</div>

                    </form>
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
        <script src="../../app/assets/demo/chart-area-demo.js"></script>
        <script src="../../app/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../../js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../../js/facturas.js"></script>
    </body>
</html>
