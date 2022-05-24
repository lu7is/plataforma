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
        $statement->execute();

    }

    public function ListarTemp(){
        $statement = $this->db->prepare("SELECT * FROM detalle_temp");
        $statement->execute();

        $json = array();

        while($row = $statement->fetch()){
            $json[] = array(
                'cantidad' => $row['cantidad'],
                'descripcion' => $row['descripcion'],
                'precio' => $row['precio'],
                'monto' => $row['monto']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;

    }









}

?>