<?php

require_once("../../modelos/tareaModel.php");

if($_POST){

    $Agregar= new Busca();
    
      $Nonbre = $_POST['Nonbre'];
      $Descrip = $_POST['Descrip'];
      $Prioridad = $_POST['Prioridad'];
      $Estado = $_POST['Estado'];

    $Agregar->Registrar($Nonbre,$Descrip,$Prioridad,$Estado);
    
}else{
   header("location:../../vistas/dashboard.php ");
}




?>