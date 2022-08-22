<?php





  
  if(!empty( $_POST['Correo']) && !empty( $_POST['Password'])){
    require_once("../modelos/loginModel.php");
    $vamos= new sesion();
    $vamos->login($_POST['Correo'],$_POST['Password']);

  }else{
    $error = "Correo Electronico o contraseña no son validos";
  }
     

  
   


?>
