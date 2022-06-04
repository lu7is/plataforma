<?php
require_once("../../modelos/gastosModel.php");

if($_POST['action'] =='registrar'){
    $regis = new Gasto();

    $Fecha = $_POST['Fecha'];
    $Concepto = $_POST['Concepto'];
    $Valor = $_POST['Valor'];
    $Proveedor = $_POST['Proveedor'];

    $regis->Registrar($Fecha, $Concepto, $Valor, $Proveedor);


}

?>