<?php

require_once("../../modelos/usuariosModel.php");

if($_POST){

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
    
}else{
   
}
?>