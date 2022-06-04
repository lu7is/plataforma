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
}




?>