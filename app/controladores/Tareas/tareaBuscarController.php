<?php

require_once("../modelos/tareaModel.php");
if(!empty($_POST)){

    $Search= new Busca();
    
     $Nombre = $_POST['Nombre'];
    

    $Search->Buscar($Nombre);
    
}else{
   header("location:../../vistas/dashboard.php ");
}




?>