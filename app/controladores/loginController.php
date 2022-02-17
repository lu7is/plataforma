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
}else{
   header('location: ../../vistas/auth/index.php ');
}

















//include_once(' ../modelos/loginModel.php');
//include_once('sesion.php');

//$sesi = new Inicio();
//$usuari = new sesion();





























  /* 

if(isset($_SESSION['usuari'])){
    echo "hay sesion";
}elseif (isset($_POST['Correo']) && isset($_POST['Password'])) {
    echo "validacion bien";

   

}else{
    echo " login";
}





















    if($_POST){

        

         echo $Correo = $_POST['Correo'];
        echo $Password = $_POST['Password'];

        //$iniciar = new Inicio();

      //  $iniciar->login($Correo, $Password);
    }else{
        header('location: ../../vistas/auth/index.php ');
    }
*/
































/*
if ($_POST) {

    echo $Correo = $_POST['Correo'];
     echo $Password = $_POST['Password'];

    $query = $connection->prepare("SELECT * FROM usuarios WHERE correo=:Correo");
    $query->bindParam('Correo',$Correo, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        if (password_verify($Password, $result['password'])) {
            $_SESSION['id'] = $result['id'];
            header("location:../../vistas/usuarios/dashboard.php ");
        } else {
            echo '<p class="error">Username password combination is wrong!</p>';
        }
    }
}

*/

    

?>


    
