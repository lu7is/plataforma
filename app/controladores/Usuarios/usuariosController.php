<?php

require_once("../../modelos/usuariosModel.php");

if($_POST['action'] == 'registrar'){

    $control = new Usuarios();

     $Cedula = $_POST['Cedula'];
     $Nombre = $_POST['Nombre'];
     $Apellido = $_POST['Apellido'];
     $Telefono = $_POST['Telefono'];
     $Direccion = $_POST['Direccion'];
     $Correo = $_POST['Correo'];
     $Password = $_POST['Password'];
     $Rol = $_POST['Rol'];

    $control->Registrar($Cedula,$Nombre,$Apellido,$Telefono,$Direccion,$Correo,$Password,$Rol );
    
}
//LISTAMOS TODOS LOS REGISTROS
if($_POST['action'] == 'listar'){
    $listar = new Usuarios();
    $listar->Listar();
}

//OPCION PARA EDITAR 
if($_POST['action'] == 'editar'){
    $Editar = new Usuarios();
    $Id = $_POST['Id'];

    $Editar->Listar_Id($Id);
}
?>