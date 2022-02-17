<?php

require_once("../modelos/tareaModel.php");
if(!empty($_POST)){

    $Search= new Busca();
    
     $name = $_POST['name'];
     $name = $_POST['name'];

    $Search->Buscar($Nombre);
    
}else{
   header("location:../../vistas/dashboard.php ");
}




?>