<?php

require_once("../modelos/usuariosModel.php");
if($_POST){

    $control= new Usuarios();
     $Id = $_POST['Id'];
    $control->Eliminar($Id);
    
}else{
   header("location:../../vistas/dashboard.php ");
}
?>