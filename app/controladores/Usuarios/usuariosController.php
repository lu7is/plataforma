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

    if(empty($Cedula)){
        $error = "Ingrese su numero de cedula";
        header('Location:../../../vistas/usuarios/principal.php');
    }

    
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
    $Cedula = $_POST['Cedula'];
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Telefono = $_POST['Telefono'];
    $Direccion = $_POST['Direccion'];
    $Correo = $_POST['Correo'];
    $Rol = $_POST['Rol'];

    $Editar->Actualizar($Id, $Cedula, $Nombre, $Apellido, $Telefono, $Direccion, $Correo, $Rol);
}

//ELIMINAR USUARIOS
if($_POST['action'] == 'eliminar'){
    $Eliminar = new Usuarios();

    $Id = $_POST['Id'];

    $Eliminar->Eliminar($Id);
}
?>