<?php

require_once("../../modelos/bodegaModel.php");

if($_POST){

   $Agregar= new Bodega();
    
      $Op = $_POST['Op'];
      $Cantidad = $_POST['Cantidad'];
      $Descrip = $_POST['Descrip'];
      $Fecha = $_POST['Fecha'];
      $Cliente = $_POST['Cliente'];

   $Agregar->Registrar($Op,$Cantidad,$Descrip,$Fecha,$Cliente);
    
}else{
   header("location:../../vistas/dashboard.php ");
}




?>