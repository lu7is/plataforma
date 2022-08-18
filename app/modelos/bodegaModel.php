<?php
require("conexion.php");

class Bodega extends BD{

    public function __construct(){
        $this->db = parent::__construct();
    }

   

    public function Registrar($Op,$Cantidad,$Recibido,$Faltantes,$Descrip,$Condicion,$Fecha,$Cliente){
        $statement = $this->db->prepare("INSERT INTO bodega (op, cantidad, recibido, faltantes, descripcion, fecha, condicion, estado, id_cliente)
                                                    VALUES (:Op, :Cantidad, :Recibido, :Faltantes, :Descrip, :Fecha, :Condicion, 'activo', :Cliente)");
        $statement->bindParam(':Op',$Op);
        $statement->bindParam(':Cantidad',$Cantidad);
        $statement->bindParam(':Recibido',$Recibido);
        $statement->bindParam(':Faltantes',$Faltantes);
        $statement->bindParam(':Descrip',$Descrip);
        $statement->bindParam(':Condicion',$Condicion);
        $statement->bindParam(':Fecha',$Fecha);
        $statement->bindParam(':Cliente',$Cliente);
        $statement->execute();
    
        }


    public function Listar(){
       // $rows = null;
        $statement = $this->db->prepare("SELECT *
                                          FROM bodega
                                          INNER JOIN usuarios
                                          WHERE bodega.id_cliente = usuarios.id_usuario AND bodega.estado = 'Activo'");
        $statement->execute();

        $json= array();

        while($row = $statement->fetch()){  
          $json[]  = array( 
                'id' => $row['id'],
                'op' => $row['op'],
                'nombre' => $row['nombre'],
                'apellido'=> $row['apellido'],
                'cantidad' => $row['cantidad'],
                'recibido' => $row['recibido'],
                'faltantes' => $row['faltantes'],
                'descripcion' => $row['descripcion'],
                'fecha' => $row['fecha'],
                'condicion' => $row['condicion'],

                'id_cliente' => $row['id_cliente']
          ); 
        }
        $jsonstring = json_encode($json);
         echo $jsonstring;
    }

    

    public function Listar_id($Id){
        
         $statement = $this->db->prepare("SELECT *  FROM bodega WHERE id = :Id ");
         $statement->bindParam(':Id', $Id);
         $statement->execute();
 
         $json= array();
         while($row = $statement->fetch()){  
           $json[]  = array( 
             'id' => $row['id'],
             'op' => $row['op'],
             'cantidad' => $row['cantidad'],
             'recibido' => $row['recibido'],
             'faltantes' => $row['faltantes'],
             'descripcion' => $row['descripcion'],
             'condicion' => $row['condicion'],
             'id_cliente' => $row['id_cliente']
           );
 
          
         }
 
         $jsonstring = json_encode($json[0]);
          echo $jsonstring;
     }


     public function Actualizar($Id,$Op,$Cantidad,$Recibido,$Faltantes,$Descrip,$Condicion,$Id_client){
        $statement = $this->db->prepare("UPDATE bodega SET op=:Op, cantidad=:Cantidad, recibido = :Recibido,
                                        faltantes = :Faltantes, descripcion = :Descrip, condicion = :Condicion, id_cliente=:Id_client WHERE id = :Id");
        $statement->bindParam(':Id',$Id);
        $statement->bindParam(':Op',$Op);
        $statement->bindParam(':Cantidad',$Cantidad);
        $statement->bindParam(':Recibido',$Recibido);
        $statement->bindParam(':Faltantes',$Faltantes);
        $statement->bindParam(':Descrip',$Descrip);
        $statement->bindParam(':Condicion',$Condicion);
        $statement->bindParam(':Id_client',$Id_client);
        $statement->execute();
          
        
    }

    public function Listar_bode($Id){
        // $rows = null;
         $statement = $this->db->prepare("SELECT bodega.id, bodega.op, bodega.cantidad, bodega.recibido, bodega.descripcion
                                          FROM bodega
                                          INNER JOIN usuarios
                                          WHERE bodega.id_cliente = usuarios.id AND usuarios.id = :Id ");
         $statement->bindParam(':Id', $Id);
         $statement->execute();
         $statement->rowCount() == 1;
 
         $json= array();

         while($row = $statement->fetch()){  
           $json[]  = array( 
             'id' => $row['id'],
             'op' => $row['op'],
             'cantidad' => $row['cantidad'],
             'recibido' => $row['recibido'],
             'descripcion' => $row['descripcion'],
           //  'fecha' => $row['fecha'],
            
           );
         }
 
         $jsonstring = json_encode($json);
          echo $jsonstring;
     }




     public function Eliminar($Id){
      $statement = $this->db->prepare("UPDATE bodega SET estado = 'inactivo' WHERE id = :Id");
      $statement->bindParam(':Id', $Id);
      $statement->execute();
  } 


}

?>



