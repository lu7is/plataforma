<?php
require_once("../../modelos/facturaModel.php");


$TokenUsu = $_SESSION['id'];

if($_POST['action'] == 'factura'){
    
       
       $Regis= new Factura(); 

        $Cantidad = $_POST['Cantidad'];
        $Descripcion = $_POST['Descripcion'];
        $Precio = $_POST['Precio'];
        $Monto = $_POST['Monto'];
        $TokenUsu = $_SESSION['id'];

       $Regis->AgregarTemp($Cantidad, $Descripcion, $Precio, $Monto,$TokenUsu);
  
    
}
?>

