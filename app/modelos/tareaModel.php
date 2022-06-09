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
        $statement = $this->db->prepare("INSERT INTO tarea (nombre, descrip, prioridad, estado, fecha, id_usuario)
                                         VALUES (:Nombre, :Descrip, :Prioridad, 'Activo',:Fecha, :TokenUsu )");
        $statement->bindParam(':Nombre',$Nombre);
        $statement->bindParam(':Descrip',$Descrip);
        $statement->bindParam(':Prioridad',$Prioridad);
        $statement->bindParam(':Fecha',$Fecha);
        $statement->bindParam(':TokenUsu',$TokenUsu);
        $statement->execute();
          
        }

    public function Listar(){
  
        $statement = $this->db->prepare("SELECT * FROM tareas ");
        $statement->execute();

        $json= array();

        while($row = $statement->fetch()){  
          $json[]  = array( 
                'nombre' => $row['nombre'],
                'descrip' => $row['descrip'],
                'prioridad' => $row['prioridad'],
                'estado' => $row['estado'],
                'id' => $row['id']
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
         $statement = $this->db->prepare("SELECT *  FROM tareas WHERE id = :Id ");
         $statement->bindParam(':Id', $Id);
         $statement->execute();
 
         $json= array();
         while($row = $statement->fetch()){  
           $json[]  = array( 
             'nombre' => $row['nombre'],
             'descrip' => $row['descrip'],
             'prioridad' => $row['prioridad'],
             'estado' => $row['estado'],
             'id' => $row['id']
           );
 
          
         }
 
         $jsonstring = json_encode($json[0]);
          echo $jsonstring;
     }


     public function Actualizar($Id, $Nonbre, $Descrip, $Prioridad, $Estado){
        $statement = $this->db->prepare("UPDATE tareas SET nombre =:Nonbre, descrip = :Descrip, prioridad = :Prioridad,
                                        estado = :Estado WHERE id = :Id");
        $statement->bindParam(':Id',$Id);
        $statement->bindParam(':Nonbre',$Nonbre);
        $statement->bindParam(':Descrip',$Descrip);
        $statement->bindParam(':Prioridad',$Prioridad);
        $statement->bindParam(':Estado',$Estado);
        $statement->execute();
          
        
    }




}

?>



