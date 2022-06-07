<?php
require_once("../../modelos/tareaModel.php");

$TokenUsu = $_SESSION['id'];

if($_POST['action'] == 'registrar'){

   $Agregar= new Busca();
    
     echo $Nonbre = $_POST['Nonbre'];
      $Descrip = $_POST['Descrip'];
      $Prioridad = $_POST['Prioridad'];
      $Fecha = $_POST['Fecha'];
      $TokenUsu = $_SESSION['id'];

   $Agregar->Registrar($Nonbre,$Descrip,$Prioridad,$Estado,$Fecha,$TokenUsu );
    
}




?>