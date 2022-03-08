<?php

require_once("../../modelos/tareaModel.php");
if($_POST){

    $control= new Busca();
     $Id = $_POST['Id'];
    $control->Eliminar($Id);
    
}else{
   header("location:../../vistas/dashboard.php ");
}
?>