<?php

require_once("../modelos/loginModel.php");

if($_POST['action'] == 'login'){

     $Correo = $_POST['Correo'];
     $Password = $_POST['Password'];

  $vamos= new sesion();
  $vamos->login($Correo,$Password);
   
}

?>
