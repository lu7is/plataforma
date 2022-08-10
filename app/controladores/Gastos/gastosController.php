<?php
date_default_timezone_set("America/Lima");
date("o-m-d ");
require_once("../../modelos/gastosModel.php");

if($_POST['action'] =='registrar'){
    $regis = new Gasto();

    $Fecha = date("o-m-d ");
    $Concepto = $_POST['Concepto'];
    $Valor = $_POST['Valor'];
    $Proveedor = $_POST['Proveedor'];

    $regis->Registrar($Fecha, $Concepto, $Valor, $Proveedor);
}

if($_POST['action'] =='listar'){
    $listar = new Gasto();
    $listar->Listar();
}
//EDITAR GASTOS
if($_POST['action'] == 'actualizar'){
    $actualizar = new Gasto();
        $Id = $_POST['Id'];
        $Fecha = date("o-m-d ");
        $Concepto = $_POST['Concepto'];
        $Valor = $_POST['Valor'];
        $Proveedor = $_POST['Proveedor'];

    $actualizar->Actualizar($Id,$Fecha,$Concepto,$Valor,$Proveedor);
}
//ELIMINAR GASTOS
if($_POST['action'] == 'eliminar'){
    $eliminar = new Gasto();
        $Id = $_POST['Id'];
       

    $eliminar->Eliminar($Id);
}
?>