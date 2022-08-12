<?php
date_default_timezone_set("America/Lima");
date("o-m-d ");
date ("g:i:s A");

require_once("../../modelos/pedidosModel.php");

if($_POST['action'] =='registrar'){
    $regis = new Pedido();

    $Opservacion = $_POST['Opservacion'];
    $Descripcion = $_POST['Descripcion'];
    $Fecha = date("o-m-d ");
    $Hora = date ("g:i:s ");
    $Proveedor = $_POST['Proveedor'];

    $regis->Registrar($Opservacion, $Descripcion, $Fecha, $Hora, $Proveedor);
}

if($_POST['action'] =='listar'){
    $listar = new Pedido();
    $listar->Listar();
}
//EDITAR BODEGAS
if($_POST['action'] == 'editar'){
   
   $Editar = new Pedido();
   $Id = $_POST['Id'];
   $Editar->Listar_id($Id);
}
//EDITAR GASTOS
if($_POST['action'] == 'actualizar'){
    $actualizar = new Pedido();
    $Id = $_POST['Id'];
    $Opservacion = $_POST['Opservacion'];
    $Descripcion = $_POST['Descripcion'];
    $Fecha = date("o-m-d ");
    $Hora = date ("g:i:s ");
    $Proveedor = $_POST['Proveedor'];

    $actualizar->Actualizar($Id,$Opservacion, $Descripcion, $Fecha, $Hora, $Proveedor);
}
//ELIMINAR GASTOS
if($_POST['action'] == 'eliminar'){
    $eliminar = new Pedido();
        $Id = $_POST['Id'];
       

    $eliminar->Eliminar($Id);
}
?>