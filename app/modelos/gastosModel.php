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
        $statement = $this->db->prepare("SELECT *
                                         FROM gasto
                                         INNER JOIN usuarios
                                         WHERE gasto.proveedor = usuarios.id_usuario AND gasto.estado = 'activo' ");
        $statement -> execute();

        $json = array();

        while($row = $statement->fetch()){
            $json[] = array(
                'id'=>$row['id'],
                'fecha'=>$row['fecha'],
                'concepto'=>$row['concepto'],
                'valor'=>$row['valor'],
                'nombre'=>$row['nombre'],
                'proveedor'=>$row['proveedor']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }


    public function Actualizar($Id,$Fecha,$Concepto,$Valor,$Proveedor){
       $statement = $this->db->prepare("UPDATE gasto SET fecha = :Fecha, concepto = :Concepto, valor = :Valor, proveedor = :Proveedor 
                                        WHERE id = :Id");
       $statement->bindParam(':Id',$Id); 
       $statement->bindParam(':Fecha',$Fecha); 
       $statement->bindParam(':Concepto',$Concepto); 
       $statement->bindParam(':Valor',$Valor); 
       $statement->bindParam(':Proveedor',$Proveedor); 
       $statement->execute();
 }

 public function Eliminar($Id){
    $statement = $this->db->prepare("UPDATE gasto SET estado = 'inactivo' WHERE id = :Id");
    $statement->bindParam(':Id', $Id);
    $statement->execute();
}























}

?>