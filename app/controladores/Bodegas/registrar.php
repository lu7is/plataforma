<?php
date_default_timezone_set("America/Lima");
date("o-m-d ");
require_once("../../modelos/bodegaModel.php");
//REGISTRAR BODEGAS  
if($_POST['action'] == 'registrar'){

   $Agregar= new Bodega();
    
      $Op = $_POST['Op'];
      $Cantidad = $_POST['Cantidad'];
      $Recibido = $_POST['Recibido'];
      $Faltantes =$_POST['Faltantes'];
      $Descrip = $_POST['Descrip'];
      $Fecha = date("o-m-d ");
      $Cliente = $_POST['Cliente'];

   $Agregar->Registrar($Op,$Cantidad,$Recibido,$Faltantes,$Descrip,$Fecha,$Cliente);
    
}




?>