<?php

require_once("conexion.php");

class Gasto extends BD{

    
    public function __construct(){
        $this->db = parent:: __construct();
    }


    public function Registrar($Fecha, $Concepto, $Valor, $Proveedor){
        //$statement = $this->db->prepare("CALL regi_Gasto($Fecha, $Concepto, $Valor, $Proveedor, )");
        $statement = $this->db->prepare("INSERT INTO gasto(fecha,concepto,valor,proveedor,estado) 
                                         VALUES(:Fecha, :Concepto, :Valor, :Proveedor,'activo') " );
        $statement->bindParam(':Fecha',$Fecha);
        $statement->bindParam(':Concepto',$Concepto);
        $statement->bindParam(':Valor',$Valor);
        $statement->bindParam(':Proveedor',$Proveedor);
        $statement->execute();
    }

    public function Listar(){
        $statement = $this->db->prepare("SELECT gasto.fecha, gasto.concepto, gasto.valor, gasto.proveedor
                                         FROM gasto
                                         WHERE gasto.estado = 'activo' ");
        $statement -> execute();

        $json = array();

        while($row = $statement->fetch()){
            $json[] = array(
                'fecha'=>$row['fecha'],
                'concepto'=>$row['concepto'],
                'valor'=>$row['valor'],
                'proveedor'=>$row['proveedor']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}




?>