<?php

require_once("../../modelos/tareaModel.php");
if($_POST){

    $control= new Busca();
     $Id = $_POST['Id'];
    

    $control->Listar_id($Id);
    
}
?>