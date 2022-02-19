<?php

require_once("../modelos/loginModel.php");
if($_POST){

     $Correo = $_POST['Correo'];
     $Password = $_POST['Password'];

  $vamos= new sesion();
  if( $vamos->login($Correo,$Password)){
    header("location:../../vistas/dashboard.php");
  }else{
    header("location:../../vistas/auth/index.php");
  }
}

?>
