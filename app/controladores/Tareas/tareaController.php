<?php
require_once("../../modelos/tareaModel.php");
session_start();
$TokenUsu = $_SESSION['id'];

if($_POST['action'] == 'registrar' ){

   $Agregar = new Busca();
    
      $Nombre = $_POST['Nombre'];
      $Descrip = $_POST['Descrip'];
      $Prioridad = $_POST['Prioridad'];
      $Fecha = $_POST['Fecha'];
      $TokenUsu = $_SESSION['id'];

   $Agregar->Registrar($Nombre,$Descrip,$Prioridad,$Fecha,$TokenUsu );
    
}
//LISTAR LAS TAREAS
if($_POST['action'] == 'listar'){

   $listar = new Busca();
   $listar->Listar();
}

//EDITAR LAS TAREAS
if($_POST['action'] == 'editar'){
   $Editar = new Busca();

    $Id = $_POST['Id'];
    
   $Editar->Listar_id($Id);
}
//ACTUALIZAR TAREAS
if($_POST['action'] == 'actualizar'){

   $control= new Busca();
    $Id = $_POST['Id'];
    $Nombre = $_POST['Nombre'];
    $Descrip = $_POST['Descrip'];
    $Prioridad = $_POST['Prioridad'];

   $control->Actualizar($Id, $Nombre, $Descrip, $Prioridad);
   
}

?>