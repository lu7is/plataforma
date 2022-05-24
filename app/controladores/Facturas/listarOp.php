<?php

require_once("../../modelos/bodegaModel.php");
if($_POST){

    $control= new Bodega();
     $Id = $_POST['Id'];
    
    $control->Listar_bode($Id);
    
}
?>