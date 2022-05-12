<?php
require_once("conexion.php");
session_start();

$id= $_SESSION['id'];


class Factura extends BD{

    public function __construct(){
        $this->db = parent:: __construct();
    }

    public function AgregarTemp($Cantidad, $Descripcion, $Precio, $Monto,$TokenUsu ){
        $statement = $this->db->prepare("CALL add_detalle_tem($Cantidad,'$Descripcion',$Precio,$Monto, '$TokenUsu' )");
        $statement->bindParam(':Cantidad',$Cantidad);
        $statement->bindParam(':Descripcion',$Descripcion);
        $statement->bindParam(':Precio',$Precio);
        $statement->bindParam(':Monto',$Monto);
        $statement->bindParam(':TokenUsu',$TokenUsu);

        $statement->execute();

    }
}

?>