<?php
date_default_timezone_set("America/Lima");
date("o-m-d ");
require_once("../../modelos/tareaModel.php");
session_start();
$TokenUsu = $_SESSION['id_usuario'];

if($_POST['action'] == 'registrar' ){

   $Agregar = new Busca();
    
      $Nombre = $_POST['Nombre'];
      $Descrip = $_POST['Descrip'];
      $Prioridad = $_POST['Prioridad'];
      $Fecha = date("o-m-d ");
      $TokenUsu = $_SESSION['id_usuario'];

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

//ELIMINAR TAREAS
if($_POST['action'] == 'eliminar'){
   $elimina = new Busca();

   $Id = $_POST['Id'];

   $elimina->Eliminar($Id);
}

?>