<?php
require("conexion.php");

class Bodega extends BD{

    public function __construct(){
        $this->db = parent::__construct();
    }

    public function Buscar($Nombre){
        //$statement = $this->db->prepare("SELECT * FROM tareas WHERE nombre LIKE ':Nombre%'");
        $statement = $this->db->prepare("SELECT * FROM tareas WHERE nombre = :Nombre");
        $statement->bindParam(':Nombre',$Nombre);
        $statement->execute();
        $statement->rowCount() == 1;
     
        $json = array();
        while($row =  $statement->fetch()){
            $json[] = array(
                'nombre' => $row['nombre'],
                'descrip' => $row['descrip'],
                'id' => $row['id']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;  
    }

    public function Registrar($Op,$Cantidad,$Recibido,$Faltantes,$Descrip,$Fecha,$Cliente){
        $statement = $this->db->prepare("INSERT INTO bodega (op, cantidad, recibido, faltantes, descripcion, fecha, estado, id_cliente)
                                                    VALUES (:Op, :Cantidad, :Recibido, :Faltantes, :Descrip, :Fecha, 'activo', :Cliente)");
        $statement->bindParam(':Op',$Op);
        $statement->bindParam(':Cantidad',$Cantidad);
        $statement->bindParam(':Recibido',$Recibido);
        $statement->bindParam(':Faltantes',$Faltantes);
        $statement->bindParam(':Descrip',$Descrip);
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
                'estado' => $row['estado'],

                'id_cliente' => $row['id_cliente']
          ); 
        }
        $jsonstring = json_encode($json);
         echo $jsonstring;
    }

    public function Eliminar($Id){
        $statement = $this->db->prepare("DELETE FROM tareas WHERE id = :Id ");
        $statement->bindParam(':Id', $Id);
        if($statement->execute()){
            die('si claro ');
        }else{
           echo "jumm parece que si ";
        }
        
        
    }

    public function Listar_id($Id){
        // $rows = null;
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
             'id_cliente' => $row['id_cliente']
           );
 
          
         }
 
         $jsonstring = json_encode($json[0]);
          echo $jsonstring;
     }


     public function Actualizar($Id,$Op,$Cantidad,$Recibido,$Faltantes,$Descrip,$Id_client){
        $statement = $this->db->prepare("UPDATE bodega SET op=:Op, cantidad=:Cantidad, recibido = :Recibido,
                                        faltantes = :Faltantes, descripcion = :Descrip, id_cliente=:Id_client WHERE id = :Id");
        $statement->bindParam(':Id',$Id);
        $statement->bindParam(':Op',$Op);
        $statement->bindParam(':Cantidad',$Cantidad);
        $statement->bindParam(':Recibido',$Recibido);
        $statement->bindParam(':Faltantes',$Faltantes);
        $statement->bindParam(':Descrip',$Descrip);
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




}

?>



