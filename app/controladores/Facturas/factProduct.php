<?php

session_start();
$id= $_SESSION['id'];

require_once("../../modelos/facturaModel.php");
if($_POST){
    
   
        $Regis = new Factura(); 
        

        $Cantidad = $_POST['Cantidad'];
        $Descripcion = $_POST['Descripcion'];
        $Precio = $_POST['Precio'];
        $Monto = $_POST['Monto'];
        $TokenUsu = md5($_SESSION['id']);

       $Regis->AgregarTemp($Cantidad, $Descripcion, $Precio, $Monto,$TokenUsu);

    
    




   
    
}
?>

