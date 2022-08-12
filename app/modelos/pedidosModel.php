<?php
require("conexion.php");

class Pedido extends BD{

    public function __construct(){
        $this->db = parent::__construct();
    }

    public function Registrar($Opservacion, $Descripcion, $Fecha, $Hora, $Proveedor){
        $statement = $this->db->prepare("INSERT INTO pedido (opserva, descripcion, fecha, hora, estado, id_prove)
                                         VALUES (:Opservacion, :Descripcion, :Fecha, :Hora, 'Activo', :Proveedor )");
        $statement->bindParam(':Opservacion',$Opservacion);
        $statement->bindParam(':Descripcion',$Descripcion);
        $statement->bindParam(':Fecha',$Fecha);
        $statement->bindParam(':Hora',$Hora);
        $statement->bindParam(':Proveedor',$Proveedor);
        $statement->execute();
          
        }

    public function Listar(){
             $statement = $this->db->prepare("SELECT  *
                                              FROM  pedido, usuarios
                                              where pedido.id_prove = usuarios.id_usuario AND pedido.estado = 'Activo'
                                              
                                            ");
             $statement->execute();
             $json= array();
             while($row = $statement->fetch()){  
               $json[]  = array( 
                     'opserva' => $row['opserva'],
                     'descripcion' => $row['descripcion'],
                     'fecha' => $row['fecha'],
                     'hora' => $row['hora'],
                    'nombre' => $row['nombre'],  
                    'id' => $row['id']
               ); 
             }
             $jsonstring = json_encode($json);
              echo $jsonstring;
         }



    public function Eliminar($Id){
        $statement = $this->db->prepare("UPDATE pedido SET estado = 'Inactivo'  WHERE id = :Id ");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
    }


    public function Listar_id($Id){
   
         $statement = $this->db->prepare("SELECT *  FROM pedido WHERE id = :Id AND estado = 'Activo' ");
         $statement->bindParam(':Id', $Id);
         $statement->execute();
         $json= array();
         while($row = $statement->fetch()){  
           $json[]  = array( 
             'id' => $row['id'],
             'opserva' => $row['opserva'],
             'descripcion' => $row['descripcion'],
             'id_prove' => $row['id_prove']
           );  
         }
 
         $jsonstring = json_encode($json[0]);
          echo $jsonstring;
     }


     public function Actualizar($Id,$Opservacion, $Descripcion, $Fecha, $Hora, $Proveedor){
        $statement = $this->db->prepare("UPDATE pedido SET  opserva=:Opservacion, descripcion = :Descripcion, fecha = :Fecha, hora = :Hora, id_prove = :Proveedor
                                        WHERE id = :Id");
         $statement->bindParam(':Id',$Id);                               
         $statement->bindParam(':Opservacion',$Opservacion);
         $statement->bindParam(':Descripcion',$Descripcion);
         $statement->bindParam(':Fecha',$Fecha);
         $statement->bindParam(':Hora',$Hora);
         $statement->bindParam(':Proveedor',$Proveedor);
        $statement->execute();
          
        
    }




}

?>



