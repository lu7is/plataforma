<?php
require("conexion.php");

class Busca extends BD{

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

    public function Registrar($Nombre,$Descrip,$Prioridad,$Fecha,$TokenUsu){
        $statement = $this->db->prepare("INSERT INTO tarea (nombre_tarea, descrip, prioridad, estado, fecha, id_usuario)
                                         VALUES (:Nombre, :Descrip, :Prioridad, 'Activo',:Fecha, :TokenUsu )");
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Descrip',$Descrip);
        $statement->bindParam(':Prioridad',$Prioridad);
        $statement->bindParam(':Fecha',$Fecha);
        $statement->bindParam(':TokenUsu',$TokenUsu);
        $statement->execute();
          
        }

    public function Listar(){
             $statement = $this->db->prepare("SELECT  tarea.id, tarea.nombre_tarea, tarea.descrip, tarea.prioridad, tarea.fecha, usuarios.nombre
                                              FROM  tarea, usuarios
                                              where tarea.id_usuario = usuarios.id AND tarea.estado = 'Activo'
                                              ORDER BY tarea.id DESC
                                            ");
             $statement->execute();
             $json= array();
             while($row = $statement->fetch()){  
               $json[]  = array( 
                     'nombre_tarea' => $row['nombre_tarea'],
                     'descrip' => $row['descrip'],
                     'prioridad' => $row['prioridad'],
                     'fecha' => $row['fecha'],
                    'nombre' => $row['nombre'],  
                    'id' => $row['id']
               ); 
             }
             $jsonstring = json_encode($json);
              echo $jsonstring;
         }



    public function Eliminar($Id){
        $statement = $this->db->prepare("UPDATE tarea SET estado = 'Inactivo'  WHERE id = :Id ");
        $statement->bindParam(':Id', $Id);
        $statement->execute();
    }


    public function Listar_id($Id){
   
         $statement = $this->db->prepare("SELECT *  FROM tarea WHERE id = :Id ");
         $statement->bindParam(':Id', $Id);
         $statement->execute();
         $json= array();
         while($row = $statement->fetch()){  
           $json[]  = array( 
             'nombre_tarea' => $row['nombre_tarea'],
             'descrip' => $row['descrip'],
             'prioridad' => $row['prioridad'],
             'id' => $row['id']
           );  
         }
 
         $jsonstring = json_encode($json[0]);
          echo $jsonstring;
     }


     public function Actualizar($Id, $Nombre, $Descrip, $Prioridad){
        $statement = $this->db->prepare("UPDATE tarea SET nombre_tarea =:Nombre, descrip = :Descrip, prioridad = :Prioridad
                                        WHERE id = :Id");
        $statement->bindParam(':Id',$Id);
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Descrip',$Descrip);
        $statement->bindParam(':Prioridad',$Prioridad);
        $statement->execute();
          
        
    }




}

?>



