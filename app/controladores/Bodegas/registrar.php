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
//LISTAR BODEGAS}
if($_POST['action'] == 'listar'){

   $Listar = new Bodega();
   $Listar->Listar();
}
//EDITAR BODEGAS
if($_POST['action'] == 'editar'){
   
   $Editar = new Bodega();
   $Id = $_POST['Id'];
   $Editar->Listar_id($Id);
}
if($_POST['action'] == 'actualizar'){

   $control= new Bodega();
    $Id = $_POST['Id'];
    $Op = $_POST['Op'];
    $Cantidad = $_POST['Cantidad'];
    $Recibido = $_POST['Recibido'];
    $Faltantes = $_POST['Faltantes'];
    $Descrip = $_POST['Descrip'];
    $Id_client = $_POST['Id_client'];

   $control->Actualizar($Id,$Op,$Cantidad,$Recibido,$Faltantes,$Descrip,$Id_client );
   
}




?>