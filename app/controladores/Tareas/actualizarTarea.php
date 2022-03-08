<?php

require_once("../../modelos/tareaModel.php");
if($_POST){

    $control= new Busca();
     $Id = $_POST['Id'];
     $Nonbre = $_POST['Nonbre'];
     $Descrip = $_POST['Descrip'];
     $Prioridad = $_POST['Prioridad'];
     $Estado = $_POST['Estado'];

    $control->Actualizar($Id, $Nonbre, $Descrip, $Prioridad, $Estado);
    
}else{
   header("location:../../vistas/dashboard.php ");
}
?>